<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\NewsPostController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdAndVideoController;
use App\Http\Controllers\ShortVideoController;
use App\Http\Controllers\BaseController;
use App\Models\ShortVideo;
use App\Http\Controllers\GroupController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/*
Route::get('/', function () {
    return view('welcome');
});
*/




// implement search functionalty
Route::get('/search', [BaseController::class, 'search'])->name('search');

Route::get('/', [MainController::class, 'index'])->name('index');
Route::get('/base', [MainController::class, 'base']); // to be deleted later
Route::get('/single', [MainController::class, 'single'])->name('single'); // to be handled properly later

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';



Route::get('/category/{category}', [NewsController::class, 'showByCategory'])->name('category.show');
Route::get('/post/{id}', [NewsController::class, 'showPost'])->name('post.show');
//Route::get('post/{post:slug}', [NewsController::class, 'showPost'])->name('post.show');




// Management interface for admin and regular users

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth:admin', 'verified'])->name('admin.dashboard');

require __DIR__.'/adminauth.php';


 // show posts to the users
 Route::get('/user/posts', [NewsPostController::class, 'showAllPostsToUser'])->name('user.posts');
 Route::get('/user/graph', [NewsPostController::class, 'showPostGraph'])->name('user.graph');






Route::resource('admin/news', NewsPostController::class);
Route::get('/admin/news', [NewsPostController::class, 'index'])->name('admin.news.index');
Route::get('/admin/news/{news}/edit', [NewsPostController::class, 'edit'])->name('admin.news.edit');

Route::get('/admin/news/{news}/update', [NewsPostController::class, 'update'])->name('admin.news.update');
Route::put('/admin/news/{news}', [NewsPostController::class, 'update'])->name('admin.news.update');

Route::delete('/admin/news/{news}', [NewsPostController::class, 'destroy'])->name('admin.news.destroy');




Route::get('/admin/news/{id}/edit', [NewsPostController::class, 'edit'])->name('admin.news.edit');
Route::post('/admin/news', [NewsPostController::class, 'store'])->name('admin.news.store');



Route::get('/admin/news/create', [NewsPostController::class, 'create'])->name('admin.news.create');

Route::post('/admin/news/store', [NewsPostController::class, 'store'])->name('admin.news.store');


// handling uploaded images via the ckeditor
Route::post('/admin/news/upload-image', [NewsPostController::class, 'uploadImage'])->name('admin.news.upload_image');
route::post('/admin/news/upload', [NewsPostController::class, 'upload'])->name('ckeditor.upload');

// handling CRUD routes
Route::resource('posts', NewsPostController::class);

 Route::get('/videos/search', [ShortVideoController::class, 'search'])->name('short_video.search');



// handling 404 page
Route::fallback(function () {
    return view('404error');
});





// try and error
    Route::post('/ad-and-video', [AdAndVideoController::class, 'store'])->name('store_ad_and_video');
    Route::get('/ad-and-video', [AdAndVideoController::class, 'index'])->name('show_ad_and_video');

    Route::get('/adlive/{id}',[AdAndVideoController::class, 'show'])->name('adlive.show');
    Route::get('/adlive/{id}/edit', [AdAndVideoController::class, 'edit'])->name('adlive.edit');
    Route::put('/adandvideo/{id}', [AdAndVideoController::class, 'update'])->name('adandvideo.update');
    Route::delete('/adlive/{id}', [AdAndVideoController::class, 'destroy'])->name('adlive.destroy');
    Route::delete('/adandvideo/{id}', [AdAndVideoController::class,'destroy'])->name('adandvideo.destroy');

    Route::post('/short_videos', [ShortVideoController::class, 'store'])->name('short_videos.store');

    // changing the create video condition using iframe for users
    Route::get('/create-video', [ShortVideoController::class, 'create'])->name('short_videos.create');
    Route::post('/create-video', [ShortVideoController::class, 'create'])->name('short_videos.create');
    Route::get('/myvideos', [ShortVideoController::class, 'myVideos'])->name('short_videos.myvideos');

   // Route::get('/manage-video', [ShortVideoController::class, 'index'])->name('short_video.index');
    Route::get('/show-all-video', [ShortVideoController::class, 'showAllVideo'])->name('short_video.show-all-videos');

    Route::post('/videos/{id}/like', [ShortVideoController::class, 'like'])->name('short_video.like');
    Route::post('/videos/{id}/view', [ShortVideoController::class, 'view'])->name('short_video.view');
    Route::get('/videos/search', [ShortVideoController::class, 'search'])->name('short_video.search');



   // managing the group controller view
   Route::resource('groups', 'GroupController');
