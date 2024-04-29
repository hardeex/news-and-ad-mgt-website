<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NewsPost;
use App\Models\Category;
use App\Models\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class NewsPostController extends Controller
{




/// uploading the media from the ckeditor
public function upload(Request $request)
{
    // Validate the uploaded file
    $request->validate([
        'upload' => 'required|file|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    try {
        if($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName.'_'. time(). '.' . $extension;
            $request->file('upload')->move(public_path('media'), $fileName);
            $url = asset('media/' . $fileName);
            return response()->json(['fileName' => $fileName, 'uploaded' => true, 'url' => $url]);
        } else {
            return response()->json(['error' => 'No file uploaded.'], 400);
        }
    } catch (\Exception $e) {
        // Handle any errors that occur during the upload process
        return response()->json(['error' => 'Failed to upload file.'], 500);
    }
}


    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $newsPosts = NewsPost::all();
        return view('admin.news.index', compact('newsPosts'));
    }





    /**
     * Show the form for creating a new resource.
     */


      public function create()
    {
        $categories = Category::pluck('name', 'id');
        return view('admin.news.create', compact('categories'));
    }





    /**
     * Store a newly created resource in storage.
     */



     public function store(Request $request)
     {

            // Check if the user is authenticated
        if (!Auth::check()) {
            return back()->with('error', 'You must be logged in to create a post.');
        }

        // Check if the authenticated user is an admin
        if (Auth::guard('admin')->check()) {
            return back()->with('error', 'Login as a user  to create posts.');
        }

         // Validate the incoming request
         $validatedData = $request->validate([
             'title' => 'required|string|max:255',
             'content' => 'required|string',
             'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
             'category' => 'required|exists:categories,id',
             'deceased_name' => 'nullable|string|max:255',
             'age' => 'nullable|integer',
         ]);

         // Handle file upload
         $imagePath = $request->file('image')->store('news_images', 'public');



         // Fetch category name
         $categoryName = Category::findOrFail($validatedData['category'])->name;

         // Create the news post with pending status
         $newsPost = new NewsPost();
         $newsPost->title = $validatedData['title'];
         $newsPost->content = $validatedData['content'];
         $newsPost->user_id = auth()->id(); // assigning each post to the user
         $newsPost->image = $imagePath;
         $newsPost->deceased_name = $validatedData['deceased_name'];
         $newsPost->age = $validatedData['age'];
         $newsPost->is_featured = $request->has('is_featured') ? true : false;
         $newsPost->is_trending = $request->has('is_trending') ? true : false;
         $newsPost->is_headline = $request->has('is_headline') ? true : false;
         $newsPost->top_topic = $request->has('top_topic') ? true : false;
         $newsPost->category = $categoryName;
         $newsPost->status = 'pending'; // Set initial status as pending
         $newsPost->save();



        return back()->with('success', 'Your post has been submitted for approval. You will hear from us shortly!');

     }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = NewsPost::findOrFail($id);
        return view('admin.news.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $post = NewsPost::findOrFail($id);
        $categories = Category::pluck('name', 'id');

        return view('admin.news.edit', compact('post', 'categories'));

    }


    /**
     * Update the specified resource in storage.
     */
    /**
 * Update the specified resource in storage.
 */

        public function update(Request $request, $id)
        {
            $post = NewsPost::findOrFail($id);

            // Validate the incoming request
            $validatedData = $request->validate([
                'title' => 'required|string|max:255',
                'content' => 'required|string',
                'category' => 'required|exists:categories,id',
                'deceased_name' => 'nullable|string|max:255',
                'age' => 'nullable|integer',
            ]);

            $categoryName = Category::findOrFail($validatedData['category'])->name;

            // Update fields
            $post->title = $validatedData['title'];
            $post->content = $validatedData['content'];
            $post->deceased_name = $validatedData['deceased_name'];
            $post->age = $validatedData['age'];
            $post->is_featured = $request->has('is_featured');
            $post->is_trending = $request->has('is_trending');
            $post->is_headline = $request->has('is_headline');
            $post->top_topic = $request->has('top_topic');
            //$post->category_id = $validatedData['category'];
            $post->category = $categoryName;


            // Handle file upload
            if ($request->hasFile('upload_image')) {
                $image = $request->file('upload_image');
                $imageName = $image->store('news_images', 'public');

                // Check if there's an existing image and delete it
                if ($post->image && Storage::disk('public')->exists($post->image)) {
                    Storage::disk('public')->delete($post->image);
                }

                $post->image = $imageName;
            }

            $post->save();

            return redirect()->route('admin.news.index')->with('success', 'News post updated successfully');
        }




    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $post = NewsPost::findOrFail($id);
        $post->delete();
        return redirect()->route('admin.news.index')->with('success', 'News post deleted successfully');
    }



    public function showAllPostsToUser()
    {
        // Retrieve the authenticated user's ID
        $userId = auth()->id();
        $user = Auth::user();
        $userPosts = NewsPost::where('user_id', $user->id)->get();

        // Fetch all approved posts associated with the authenticated user
        $approvedPosts = NewsPost::where('status', 'approved')
                                ->where('user_id', $userId)
                                ->get();

        return view('users.posts', compact('approvedPosts', 'user', 'userPosts'));
    }


    public function showPostGraph()
    {
        // Retrieve the categories and count of posts for each category
        $postCounts = DB::table('news_posts')
            ->select('categories.name as category', DB::raw('COUNT(*) as count'))
            ->join('categories', 'news_posts.category', '=', 'categories.name')
            ->groupBy('categories.name')
            ->get();

        // Extract category names and post counts from the query result
        $postCategories = $postCounts->pluck('category')->toArray();
        $counts = $postCounts->pluck('count')->toArray();

        // Retrieve the approved posts
        $approvedPosts = NewsPost::where('status', 'approved')->get();

        // Pass the data to the view
        return view('users.graph', compact('postCategories', 'counts', 'approvedPosts'));
    }


    public function showUserPostGraph()
    {
        // Retrieve the users and count of posts for each user
        $userPostCounts = DB::table('news_posts')
            ->select('users.name as user', DB::raw('COUNT(*) as count'))
            ->join('users', 'news_posts.user_id', '=', 'users.id')
            ->groupBy('users.name')
            ->get();

        // Extract user names and post counts from the query result
        $userNames = $userPostCounts->pluck('user')->toArray();
        $postCounts = $userPostCounts->pluck('count')->toArray();

        // Retrieve all approved posts
        $approvedPosts = NewsPost::where('status', 'approved')->get();

        // Pass the data to the view
        return view('admin.news.usergraph', compact('userNames', 'postCounts', 'approvedPosts'));
    }


}
