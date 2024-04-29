<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NewsPost;
use App\Models\Category;
use App\Models\Image;
use Illuminate\Support\Facades\View;

class NewsController extends Controller
{



     // Display news posts by category
     public function showByCategory($category)
     {
         // Fetch category by name
         $category = Category::where('name', $category)->first();
         $newsPostsFooter = NewsPost::where('status', 'approved')->orderBy('created_at', 'desc')->get();

         if (!$category) {
             return view('news.no-news-post');
         }

            // Fetch news posts by category ID
        $newsPosts = NewsPost::where('status', 'approved')
        ->where('category', $category->name)
        ->orderBy('created_at', 'desc')
        ->get();

        // Fetch recent approved posts
        $recentPosts = NewsPost::where('status', 'approved')
        ->orderBy('created_at', 'desc')
        ->take(8)
        ->get();



         if ($newsPosts->isEmpty()) {
             return view('news.no-news-post');
         }

         return view('news.category', compact('category', 'newsPosts', 'recentPosts', 'newsPostsFooter'));
     }


     // Display individual news post
   // Display individual news post
   public function showPost($id)
   {
       $post = NewsPost::find($id);
       $approvedPosts = NewsPost::where('status', 'approved')->get();
       $newsPostsFooter = NewsPost::all();

       if (!$post) {
           return view('news.no-news-post');
       }

       // Fetch recent posts
       $recentPosts = NewsPost::where('status', 'approved')
       ->orderBy('created_at', 'desc')
       ->take(8)
       ->get();
       // Fetch categories
       $categories = Category::all();

       return view('news.post')
           ->with('post', $post)
           ->with('recentPosts', $recentPosts)
           ->with('categories', $categories)
           ->with('newsPostsFooter', $newsPostsFooter)
           ->with('approvedPosts', $approvedPosts);
   }

   public function showPostSlug($slug)
   {
       $post = NewsPost::where('slug', $slug)->first();
       $approvedPosts = NewsPost::where('status', 'approved')->get();
       $newsPostsFooter = NewsPost::all();

       if (!$post) {
           return view('news.no-news-post');
       }

       // Fetch recent posts
       $recentPosts = NewsPost::where('status', 'approved')
           ->orderBy('created_at', 'desc')
           ->take(8)
           ->get();
       // Fetch categories
       $categories = Category::all();

       return view('news.post')
           ->with('post', $post)
           ->with('recentPosts', $recentPosts)
           ->with('categories', $categories)
           ->with('newsPostsFooter', $newsPostsFooter)
           ->with('approvedPosts', $approvedPosts);
   }











}
