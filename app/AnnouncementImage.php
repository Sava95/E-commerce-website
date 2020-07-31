<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Announcement;

class AnnouncementImage extends Model
{
   public function announcement()
   {
       return $this->belongsTo(Announcement::class);
   }
}
