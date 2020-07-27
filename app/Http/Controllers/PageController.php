<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Announcement;

class PageController extends Controller
{
    public function index() {
        $announcements = Announcement::orderBy('created_at')->take(5)->get();
        return view('welcome', compact('announcements'));
    }
}
