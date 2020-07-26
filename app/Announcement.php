<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    protected $guarded = [];

    public function categories()
    {
        return $this->belongsToMany('App\Category');
    }
}
