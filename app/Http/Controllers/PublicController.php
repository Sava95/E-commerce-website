<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Announcement;
use App\Category;
use Illuminate\Support\Facades\View;
use App\AnnouncementImage;
use App;

class PublicController extends Controller
{
    public function __construct()
    {
        $categories = Category::all();
        View::share('categories', $categories);
    }

    public function index() 
    {
        $announcements = Announcement::where('is_accepted', true)->orderBy('created_at', 'desc')->paginate(5);
        
        return view('list_of_ads', compact('announcements'));
    }

    public function welcome() 
    {   
        $announcements = Announcement::all()->where('is_accepted', true);
        $carousel_1 = $announcements->take(4);
        $carousel_2 = $announcements->slice(4, 4);   // takes elements: 4, 5, 6, 7 (4 - start, 4 - how many elements)

        
        return view('welcome', compact('announcements', 'carousel_1', 'carousel_2') );
    }

 
    public function announcementsByCategory($name, $category_id) 
    {
        $category = Category::find($category_id);
        $announcements = $category->announcements()->where('is_accepted', true)->orderBy('created_at', 'desc')->paginate(5);

        return view('_announcements', compact('category', 'announcements'));
    }

    public function locale($locale)
    {
       
        session()->put('locale', $locale);
        return redirect()->back();
    }

    public function search(Request $request)
    {
        $q = $request->input('q');
        $announcements = Announcement::search($q)
            ->where('is_accepted', true)
            ->get();
        return view('search_results', compact('q', 'announcements'));
    }  
}