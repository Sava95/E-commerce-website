<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\AnnouncementImage;
use Google\Cloud\Vision\V1\ImageAnnotatorClient;

class GoogleVisionSafeSearchImage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $announcement_image_id;

    public function __construct($announcement_image_id)
    {
        $this->announcement_image_id = $announcement_image_id;
    }

    /**
     * Execute the job.
     *
     * @return void - void means that it doesnt't return anything , this is all a comment
     */

    public function handle()
    {
        $i = AnnouncementImage::find($this->announcement_image_id);

        if (!$i) {
            return;
        }

        $image = file_get_contents(storage_path('/app/' . $i->file));

        // setting the google application credentials to path of the credentials file 
        putenv('GOOGLE_APPLICATION_CREDENTIALS=' . base_path('google_credentials.json')); 
        
        $imageAnnotator = new ImageAnnotatorClient();  // from the google vision API library
        $response = $imageAnnotator->safeSearchDetection($image);
        $imageAnnotator->close();

        $safe = $response->getSafeSearchAnnotation();

        $adult = $safe->getAdult();
        $medical = $safe->getMedical();
        $spoof = $safe->getSpoof();
        $violence = $safe->getViolence();
        $racy = $safe->getRacy();

        echo json_encode([$adult, $medical, $spoof, $violence, $racy]);

        $likelihoodName = ['UNKNOWN', 'VERY_UNLIKELY', 'UNLIKELY', 'POSSIBLE', 'LIKELY', 'VERY_LIKELY'];

        $i->adult = $likelihoodName[$adult];
        $i->medical = $likelihoodName[$medical];
        $i->spoof = $likelihoodName[$spoof];
        $i->violence = $likelihoodName[$violence];
        $i->racy = $likelihoodName[$racy];

        $i->save();


    }
}
