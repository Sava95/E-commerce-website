<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use App\Announcement;

class AnnouncementImage extends Model
{
   public function announcement()
   {
       return $this->belongsTo(Announcement::class);
   }

   static public function getUrlByFilePath($filePath, $w = null, $h = null)
   {
       if(!$w && !$h){
           return Storage::url($filePath);
       }

       $path = dirname($filePath);
       $filename = basename($filePath);

       $file = "{$path}/crop{$w}x{$h}_{$filename}";

       return Storage::url($file);
   }

   public function getUrl($w = null, $h = null)
   {
       return AnnouncementImage::getUrlByFilePath($this->file, $w, $h);
   }
}
