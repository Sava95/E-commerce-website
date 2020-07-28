<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Announcement;
use App\Category;
use Illuminate\Support\Facades\View;

class PublicController extends Controller
{
    public function __construct()
    {
        $categories = Category::all();
        View::share('categories', $categories);
    }

    public function index() 
    {
        $announcements = Announcement::where('is_accepted', true)->orderBy('created_at', 'desc')->take(5)->get();
        
        return view('welcome', compact('announcements'));
    }

 
    public function announcementsByCategory($name, $category_id) 
    {
        $category = Category::find($category_id);
        $announcements = $category->announcements()->where('is_accepted', true)->orderBy('created_at', 'desc')->paginate(5);

        return view('_announcements', compact('category', 'announcements'));
    }
}