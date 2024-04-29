<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache; 
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\NewsPost;
use App\Models\Category; 
use App\Models\Image;
use App\Models\AdAndVideo;
use Illuminate\Support\Facades\Storage;
use App\Models\ShortVideo;


class MainController extends Controller
{
 
    

    public function index()
    {
        // Fetch the news
        $newsPosts = NewsPost::where('status', 'approved')->orderBy('created_at', 'desc')->get(); 
        $newsPostsFooter = NewsPost::where('status', 'approved')->orderBy('created_at', 'desc')->get(); 
        $liveDesc = AdAndVideo::all();
        $shortVideos = ShortVideo::all();

       
        // Fetch the vertical ads
        $verticalAds = AdAndVideo::whereNotNull('vertical_ad')->get();
        $horizontalAds = AdAndVideo::whereNotNull('horizontal_ad')->get();
        $liveVideos = AdAndVideo::whereNotNull('video_upload')->get();
        $youtubeVideos = AdAndVideo::whereNotNull('video_link')->get();

            // Fetch view and like data for short videos
       

        // Pass the derived data to the view
        return view('home', [
          
            'newsPosts' => $newsPosts,
            'verticalAds' => $verticalAds,
            'horizontalAds' => $horizontalAds,
            'liveVideos' => $liveVideos,
            'liveDesc' => $liveDesc,
            'shortVideos'=>$shortVideos,
            'newsPostsFooter'=>$newsPostsFooter,
            'youtubeVideos'=> $youtubeVideos,
        ]);
    }

   
    
   
     // the index or home page --- to be deleted
     public function base(){
        return view('base.base');
    }
    

    // calling the single that handle each post
    public function single(){
        return view('single');
    }



   
    
}
