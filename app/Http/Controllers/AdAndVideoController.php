<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdAndVideo;
use Illuminate\Support\Facades\Storage;


class AdAndVideoController extends Controller
{


    public function adlive()
    {
        $adlive = AdAndVideo::all();
        return view('admin.adlivmanage', ['adlive' => $adlive]);
    }


    public function showAdLive($id)
    {
        $post = AdAndVideo::find($id);

        if (!$post) {
            return view('news.no-news-post');
        }

        return view('news.post')->with('post', $post);
    }



    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $verticalAds = AdAndVideo::whereNotNull('vertical_ad')->get();
        return view('adandvideo.index', compact('verticalAds'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'vertical_ad' => 'nullable|image|max:2048',
            'horizontal_ad' => 'nullable|image|max:2048',
            'video_upload' => 'nullable|file|mimes:mp4,mov,avi|max:30480',
            'video_link' => 'nullable|url',
        ]);

        // Retrieve the previous ad and video record (if any)
        $previousAdAndVideo = AdAndVideo::latest()->first();

        // Handle file uploads and store the paths in variables
        $verticalAdPath = $request->file('vertical_ad') ? $request->file('vertical_ad')->store('vertical_ads', 'public') : null;
        $horizontalAdPath = $request->file('horizontal_ad') ? $request->file('horizontal_ad')->store('horizontal_ads', 'public') : null;
        $videoUploadPath = $request->file('video_upload') ? $request->file('video_upload')->store('video_uploads', 'public') : null;

        // Delete previous images
       // Delete previous images if they exist
        if ($previousAdAndVideo && $previousAdAndVideo->vertical_ad) {
            Storage::delete($previousAdAndVideo->vertical_ad);
        }
        if ($previousAdAndVideo && $previousAdAndVideo->horizontal_ad) {
            Storage::delete($previousAdAndVideo->horizontal_ad);
        }

        if ($previousAdAndVideo && $previousAdAndVideo->video_upload) {
            Storage::delete($previousAdAndVideo->video_upload);
        }


        // Store the form data in the database
        $adAndVideo = new AdAndVideo();
        $adAndVideo->title = $validatedData['title'];
        $adAndVideo->description = $validatedData['description'];
        $adAndVideo->vertical_ad = $verticalAdPath;
        $adAndVideo->horizontal_ad = $horizontalAdPath;
        $adAndVideo->video_upload = $videoUploadPath;

        // Check if 'video_link' key exists in $validatedData before accessing it
        $adAndVideo->video_link = isset($validatedData['video_link']) ? $validatedData['video_link'] : null;




        $adAndVideo->save();

        // Redirect back with success message
        return redirect()->back()->with('success', 'Ad or video added successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $adlive = AdAndVideo::findOrFail($id);
        return view('adandvideo.show', compact('adlive'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $adlive = AdAndVideo::findOrFail($id);
        return view('adandvideo.edit', compact('adlive'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Find the ad and video item by ID
        $adAndVideo = AdAndVideo::findOrFail($id);

        // Validate the form data
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'vertical_ad' => 'nullable|image|max:2048',
            'horizontal_ad' => 'nullable|image|max:2048',
            'video_upload' => 'nullable|file|mimes:mp4,mov,avi|max:30480',
            'video_link' => 'nullable|url',
        ]);

        // Update the ad and video item's title and description
        $adAndVideo->title = $validatedData['title'];
        $adAndVideo->description = $validatedData['description'];

        // Handle file uploads and update the paths in the database
        if ($request->hasFile('vertical_ad')) {
            // Delete previous vertical ad if it exists
            if ($adAndVideo->vertical_ad) {
                Storage::delete($adAndVideo->vertical_ad);
            }
            // Store new vertical ad and update path
            $adAndVideo->vertical_ad = $request->file('vertical_ad')->store('vertical_ads', 'public');
        }

        if ($request->hasFile('horizontal_ad')) {
            // Delete previous horizontal ad if it exists
            if ($adAndVideo->horizontal_ad) {
                Storage::delete($adAndVideo->horizontal_ad);
            }
            // Store new horizontal ad and update path
            $adAndVideo->horizontal_ad = $request->file('horizontal_ad')->store('horizontal_ads', 'public');
        }

        if ($request->hasFile('video_upload')) {
            // Delete previous video upload if it exists
            if ($adAndVideo->video_upload) {
                Storage::delete($adAndVideo->video_upload);
            }
            // Store new video upload and update path
            $adAndVideo->video_upload = $request->file('video_upload')->store('video_uploads', 'public');
        }

        // Update video link
        $adAndVideo->video_link = $validatedData['video_link'];

        // Save the changes
        $adAndVideo->save();

        // Redirect back with success message
        //return redirect()->back()->with('success', 'Ad and video updated successfully.');
        return redirect()->route('news.adlivmanage')->with('success', 'Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Find the ad and video item by ID
        $adAndVideo = AdAndVideo::findOrFail($id);

        // Delete any associated files (vertical ad, horizontal ad, video upload)
        if ($adAndVideo->vertical_ad) {
            Storage::delete($adAndVideo->vertical_ad);
        }
        if ($adAndVideo->horizontal_ad) {
            Storage::delete($adAndVideo->horizontal_ad);
        }
        if ($adAndVideo->video_upload) {
            Storage::delete($adAndVideo->video_upload);
        }

        // Delete the ad and video item from the database
        $adAndVideo->delete();

        // Redirect back with success message
        return redirect()->back()->with('success', 'Ad and video deleted successfully.');
    }
}
