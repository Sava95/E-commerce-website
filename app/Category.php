<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Announcement;

class Category extends Model
{
    public function announcement()
    {
        return $this->hasMany(Announcement::class);
    }
}
