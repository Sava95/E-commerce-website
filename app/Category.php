<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = [];

    public function announcements()
    {
        return $this->hasMany('App\Announcement');
    }
}
