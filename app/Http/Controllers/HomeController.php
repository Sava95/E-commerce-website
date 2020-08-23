<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Announcement;
use App\Http\Requests\AnnouncementRequest;
use App\Category;
use Illuminate\Support\Facades\View;
use App\AnnouncementImage;
use App\Jobs\ResizeImage;
use App\Jobs\GoogleVisionSafeSearchImage;
use App\Jobs\GoogleVisionLabelImage;
use App\Jobs\GoogleVisionRemoveFaces;

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
        $new_announcement->price = $request->input('price');
        $new_announcement->save();

        $uniqueSecret = $request->input('uniqueSecret');

        $images = session()->get("images.{$uniqueSecret}", []); // get the image from the temp folder
        $removedImages = session()->get("removedImages.{$uniqueSecret}", []); // [] - default value


        $images = array_diff($images, $removedImages);


        foreach ($images as $image) {
            $i = new AnnouncementImage();

            $fileName = basename($image); 
            $newfileName = "public/announcements/{$new_announcement->id}/{$fileName}";  
            Storage::move($image, $newfileName); // from temp to public 
            
            $file =  "storage/announcements/{$new_announcement->id}/{$fileName}";
            $data = getimagesize($file);
            $width = $data[0];
            $height = $data[1];

            /*
            if ($width > $height) {
                dispatch(new ResizeImage($newfileName, 300, 200)); // The dispatch function pushes the job onto the Laravel job queue
            }
            else {
                dispatch(new ResizeImage($newfileName, 200, 300)); // The dispatch function pushes the job onto the Laravel job queue
            }
            */

            $i->file = $newfileName;
            $i->announcement_id = $new_announcement->id; 

            $i->save();

            /*
            dispatch(new GoogleVisionSafeSearchImage($i->id));
            dispatch(new GoogleVisionLabelImage($i->id));
            dispatch(new GoogleVisionRemoveFaces($i->id));
            */
            
            if ($width > $height) {
                GoogleVisionSafeSearchImage::withChain([
                    new GoogleVisionLabelImage($i->id),
                    new GoogleVisionRemoveFaces($i->id),
                    new ResizeImage($i->file, 300, 200)
                ]) -> dispatch($i->id);
            } else {
                GoogleVisionSafeSearchImage::withChain([
                    new GoogleVisionLabelImage($i->id),
                    new GoogleVisionRemoveFaces($i->id),
                    new ResizeImage($i->file, 200, 300)
                ]) -> dispatch($i->id);
            }
    
        }

        File::deleteDirectory(storage_path("/app/public/temp/{$uniqueSecret}"));

        
        return redirect('/')->with('announcement.create.success','ok');
       
    }
    
    public function uploadImages(Request $request)
    {
        $uniqueSecret = $request->input('uniqueSecret');
        $fileName = $request->file('file')->store("public/temp/{$uniqueSecret}"); //file-atribute of the request,'file'- type of data

        dispatch(new ResizeImage($fileName, 120, 120));

        session()->push("images.{$uniqueSecret}", $fileName); // "images...."- temp folder, "$fileName" - PATH that contains the img
        
        return response()->json(['id'=>$fileName]);
    
        
    }

    public function removeImages(Request $request)
    {       
        $uniqueSecret = $request->input('uniqueSecret');
        $fileName = $request->input('id'); // announcementImages.js - id: file.serverId
        session()->push("removedImages.{$uniqueSecret}", $fileName);
        Storage::delete($fileName);

        return response()->json('ok');
    }
    
    public function getImages(Request $request) // for representing images on views
    {
        $uniqueSecret = $request->input('uniqueSecret');

        $images = session()->get("images.{$uniqueSecret}", []); // [] - means all off them
        $removedImages = session()->get("removedImages.{$uniqueSecret}", []);

        $images = array_diff($images, $removedImages);

        $data = []; // storing in json format

        foreach($images as $image) {
            $data[] = [
                'id'=> $image,
                'src'=> AnnouncementImage::getUrlByFilePath($image, 120, 120)
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
