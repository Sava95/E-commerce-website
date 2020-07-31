<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Announcement;
use App\Http\Requests\AnnouncementRequest;
use App\Category;
use Illuminate\Support\Facades\View;
use App\AnnouncementImage;

use Storage;
use File;
use Auth;

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

    public function newAnnouncement(Request $request) 
    {
        // $uniqueSecret = base_convert(sha1(uniqid(mt_rand())), 16, 36);
        $uniqueSecret = $request->old('uniqueSecret', base_convert(sha1(uniqid(mt_rand())), 16, 36));
        return view('announcement.new', compact('uniqueSecret')); 
    }
    
    public function createAnnouncement(AnnouncementRequest $request)
    {

        $new_announcement = new Announcement();

        $new_announcement->title = $request->input('title');
        $new_announcement->body = $request->input('body');
        $new_announcement->category_id = $request->input('category');
        $new_announcement->user_id = Auth::user()->id;
        $new_announcement->save();

        $uniqueSecret = $request->input('uniqueSecret');

        $images = session()->get("images.{$uniqueSecret}", []); // get the image from the temp folder
        $removedImages = session()->get("removedImages.{$uniqueSecret}", []);

        $images = array_diff($images, $removedImages);

        foreach ($images as $image) {
            $i = new AnnouncementImage();

            $fileName = basename($image); // not aa.jpg, not uniqueSecret, random generated name of the browser
            $newfileName = "/public/announcements/{$new_announcement->id}/{$fileName}";  // from temp to public folder
            Storage::move($image, $newfileName);

            $i->file = $newfileName;
            $i->announcement_id = $new_announcement->id;

            $i->save();
        }

        File::deleteDirectory(storage_path("/app/public/temp/{$uniqueSecret}"));


        return redirect('/')->with('announcement.create.success','ok');
       
    }
    
    public function uploadImages(Request $request)
    {
        $uniqueSecret = $request->input('uniqueSecret');
        $fileName = $request->file('file')->store('public/temp/{$uniqueSecret}');
        session()->push("images.{$uniqueSecret}", $fileName);
        
        return response()->json(['id'=>$fileName]);
        
    }

    public function removeImages(Request $request)
    {       
        $uniqueSecret = $request->input('uniqueSecret');
        $fileName = $request->input('id');
        session()->push("removedImages.{$uniqueSecret}", $fileName);
        Storage::delete($fileName);

        return response()->json('ok');
    }
    
    public function getImages(Request $request) // 
    {
        $uniqueSecret = $request->input('uniqueSecret');

        $images = session()->get("images.{$uniqueSecret}", []); // [] - means all off them
        $removedImages = session()->get("removedImages.{$uniqueSecret}", []);

        $images = array_diff($images, $removedImages);

        $date = []; // storing in json format

        foreach($images as $image) {
            $data[] = [
                'id'=> $image,
                'src'=> Storage::url($image)
            ];
        }

        return response()->json($data);
    }
   
    public function oneAnnouncement($name, $id)
    {
        $announcement = Announcement::find($id);
       
        return view('announcement.details', compact('announcement'));
    }


}
