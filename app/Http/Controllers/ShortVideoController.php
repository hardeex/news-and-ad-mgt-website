<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShortVideo;
use App\Models\NewsPost;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;
use Illuminate\Support\Facades\Log;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class ShortVideoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $shortVideos = ShortVideo::all()->take(10)->sortByDesc('created_at');
        return view('short_video.index', compact('shortVideos'));
    }

    public function myVideos()
    {
        // Get the currently authenticated user
        $user = auth()->user();
    
        // Retrieve the videos uploaded by the authenticated user
        $shortVideos = ShortVideo::where('user_id', $user->id)
                        ->orderByDesc('created_at')
                        ->get();
    
        return view('short_video.myvideos', compact('shortVideos'));
    }
    


    public function showAllVideo(){
        $shortVideos = ShortVideo::orderBy('created_at', 'desc')->paginate(9); 
        return view('short_video.show-all-videos', compact('shortVideos'));
    }
    
    

    public function like(Request $request, $id)
    {
        $video = ShortVideo::findOrFail($id);
        $video->increment('likes');
        return response()->json(['likes' => $video->likes]);
    }

    public function view(Request $request, $id)
    {
        $video = ShortVideo::findOrFail($id);
        $video->increment('views');
        return response()->json(['views' => $video->views]);
    }
    

    public function search(Request $request)
    {
        $query = $request->input('query');
        $shortVideos = ShortVideo::where('title', 'like', "%$query%")
            ->orWhere('description', 'like', "%$query%")
            ->paginate(10);
        return view('short_video.show-all-videos', compact('shortVideos'));
    }
    
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('short_video.create');
    }

    /**
     * Store a newly created resource in storage.
     */
   
   
    

     public function store(Request $request)
     {
         try {
             $validatedData = $request->validate([
                 'title' => 'required|string|max:255',
                 'description' => 'nullable|string',
                 'short_video' => 'required|file|mimes:mp4|max:1500000', // Adjusted max file size
             ]);
     
             $videoPath = $request->file('short_video')->store('short_videos', 'public');
     
             $shortVideo = ShortVideo::create([
                 'title' => $validatedData['title'],
                 'description' => $validatedData['description'],
                 'video_path' => $videoPath,
                 'likes' => 0,
                 'views' => 0,
             ]);
     
             // Generate thumbnail
             $media = Media::findByUrl(asset("storage/{$shortVideo->video_path}"));
             $thumbnailPath = $media->generateThumbnail()->getPath();
     
             // Debugging: Check if the $shortVideo object contains the expected data
             dd($shortVideo);
     
             return redirect()->back()->with('success', 'Short video uploaded successfully.');
         } catch (\Exception $e) {
             // Log the error for debugging
             Log::error('Error storing video: ' . $e->getMessage());
             // Return an error message or redirect back with an error
             return redirect()->back()->with('error', 'Failed to upload video. Please try again.');
         }
     }
     
     
     
     
     
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $post = ShortVideo::findOrFail($id);
       
    
        return view('short_video.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $post = ShortVideo::findOrFail($id);
        $post->delete();
        return redirect()->route('short_video.index')->with('success', 'Ad deleted successfully');
    }

    
}
