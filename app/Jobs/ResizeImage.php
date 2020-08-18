<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Spatie\Image\Image;
use Spatie\Image\Manipulations;

class ResizeImage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $path, $fileName, $w, $h;

    public function __construct($filePath, $w, $h)
    {
        $this->path = dirname($filePath);
        $this->fileName = basename($filePath);
        $this->w = $w;
        $this->h = $h;
    }

    public function handle()
    {
        $w = $this->w;
        $h = $this->h;
        
        $srcPath = storage_path() . '/app/' . $this->path . '/' . $this->fileName;
        $descPath = storage_path() . '/app/' . $this->path . "/crop{$w}x{$h}_" . $this->fileName;

        Image::load($srcPath)->crop(Manipulations::CROP_CENTER, $w, $h)->save($descPath);
    }
}
