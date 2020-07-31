<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Category;
use App\User;
use App\AnnouncementImage;

class Announcement extends Model
{
    public function category()
    {   
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function images()
    {
        return $this->hasMany(AnnouncementImage::class);
    }


    static public function ToBeRevisionedCount()
    {
        return Announcement::where('is_accepted', null)->count();
    }


}
