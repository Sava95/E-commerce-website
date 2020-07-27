<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Announcement;
use App\Http\Requests\AnnouncementRequest;
use App\Category;
use Illuminate\Support\Facades\View;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $categories = Category::all();
        View::share('categories', $categories);

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    # My Controls

    public function newAnnouncement() 
    {
        return view('announcement.new'); 
    }
    
    public function createAnnouncement(AnnouncementRequest $request)
    {

        $new_announcement = new Announcement();

        $new_announcement->title = $request->input('title');
        $new_announcement->body = $request->input('body');
        $new_announcement->category_id = $request->input('category');
        $new_announcement->save();

        return redirect('/')->with(['announcement.create.success' => 'ok']);
       
    }

}
