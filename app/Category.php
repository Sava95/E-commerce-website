<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Announcement;

class Category extends Model
{
    public function announcements()
    {
        return $this->hasMany(Announcement::class);
    }
}
