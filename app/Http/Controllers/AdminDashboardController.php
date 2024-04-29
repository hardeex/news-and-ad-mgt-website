<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdAndVideo;
use App\Models\NewsPost;
use Illuminate\Support\Facades\Auth;
use Closure;


class AdminDashboardController extends Controller
{
    


    // the admin home page
    public function index()
    {
        $newsPosts = NewsPost::all();
        return view('admin.dashboard', compact('newsPosts'));
    }

    
  
    public function post()
    {
        $newsPosts = NewsPost::all();
        return view('admin.news.post', compact('newsPosts'));
    }

    public function pending(){
        $newsPosts = NewsPost::all();
        // Fetch pending news posts for admin approval
        $pendingNewsPosts = NewsPost::where('status', 'pending')->get();        
        return view('admin.news.pending', compact('pendingNewsPosts', 'newsPosts'));
    }

    public function approve($id)
    {
        $post = NewsPost::findOrFail($id);
        $post->status = 'approved';
        $post->save();
        return redirect()->back()->with('success', 'News post approved successfully!');
    }
    
    public function reject($id)
    {
        $post = NewsPost::findOrFail($id);
        $post->status = 'rejected';
        $post->save();
        return redirect()->back()->with('success', 'News post rejected successfully!');
    }

    public function showApprovedPost()
    {
        $approvedPosts = NewsPost::where('status', 'approved')->get();        
        
        return view('admin.news.approved_posts', compact('approvedPosts'));
    }

    public function showRejectedPost()
    {
        //$approvedPosts = NewsPost::where('status', 'approved')->get();
        $rejectedPosts = NewsPost::where('status', 'rejected')->get();
        
        return view('admin.news.rejected_post', compact('rejectedPosts'));
    }


    
    
}    
