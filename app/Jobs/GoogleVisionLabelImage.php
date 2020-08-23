<?php

namespace App\Jobs;

use App\AnnouncementImage;
use Google\Cloud\Vision\V1\ImageAnnotatorClient;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class GoogleVisionLabelImage implements ShouldQueue
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
     * @return void
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
        $response = $imageAnnotator->labelDetection($image);
        $labels = $response->getLabelAnnotations();

        if($labels) {
            $result=[];
            
            foreach ($labels as $label){
                $result[] = $label->getDescription();
            }

            $i->labels = $result;
            $i->save();

        }

        $imageAnnotator->close(); 
    }
}
