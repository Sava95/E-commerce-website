<?php

namespace App;

use App\Category;
use App\User;
use App\AnnouncementImage;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;



class Announcement extends Model
{
    use Searchable;

    public function toSearchableArray() 
    {
        $array = [
            'id' => $this->id,
            'title' => $this->title,
            'body' => $this->body, 
            'other' => 'announcements announcement'
        ];

        return $array;
    }

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
