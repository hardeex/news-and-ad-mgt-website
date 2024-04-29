<?php

use App\Http\Controllers\AdminAuth\AuthenticatedSessionController;
use App\Http\Controllers\AdminAuth\ConfirmablePasswordController;
use App\Http\Controllers\AdminAuth\EmailVerificationNotificationController;
use App\Http\Controllers\AdminAuth\EmailVerificationPromptController;
use App\Http\Controllers\AdminAuth\NewPasswordController;
use App\Http\Controllers\AdminAuth\PasswordController;
use App\Http\Controllers\AdminAuth\RegisteredUserController;
use App\Http\Controllers\AdminAuth\PasswordResetLinkController;
use App\Http\Controllers\AdminAuth\VerifyEmailController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsPostController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdAndVideoController;
use App\Http\Controllers\ShortVideoController;

Route::middleware('guest:admin')->group(function () {
    // start of playing around ---- kindly delete before launching live from startn of playing around to end of playing around

    Route::get('admin/register', [RegisteredUserController::class, 'create'])
    ->name('admin.register'); // to allow admi to register

    Route::post('admin/register', [RegisteredUserController::class, 'store']);




    // end of playing around

    Route::get('admin/login', [AuthenticatedSessionController::class, 'create'])
                ->name('admin.login');


    Route::post('admin/login', [AuthenticatedSessionController::class, 'store']);

    Route::get('admin/forgot-password', [PasswordResetLinkController::class, 'create'])
                ->name('admin.password.request');

    Route::post('admin/forgot-password', [PasswordResetLinkController::class, 'store'])
                ->name('admin.password.email');

    Route::get('admin/reset-password/{token}', [NewPasswordController::class, 'create'])
                ->name('admin.password.reset');

    Route::post('admin/reset-password', [NewPasswordController::class, 'store'])
                ->name('admin.password.store');
});

Route::middleware('auth:admin')->group(function () {
    Route::get('admin/verify-email', EmailVerificationPromptController::class)
                ->name('admin.verification.notice');

    Route::get('admin/verify-email/{id}/{hash}', VerifyEmailController::class)
                ->middleware(['signed', 'throttle:6,1'])
                ->name('admin.verification.verify');

    Route::post('admin/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware('throttle:6,1')
                ->name('admin.verification.send');

    Route::get('admin/confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->name('admin.password.confirm');

    Route::post('admin/confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('admin/password', [PasswordController::class, 'update'])->name('admin.password.update');

    Route::post('admin/logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('admin.logout');


    // adding the custom routes
    Route::get('/admin/approved-post', [AdminDashboardController::class, 'showApprovedPost'])->name('admin.news.approved_posts');
    Route::get('/admin/rejected-post', [AdminDashboardController::class, 'showRejectedPost'])->name('admin.news.rejected_post');
    Route::get('/admin/pending-news-posts', [AdminDashboardController::class, 'pending'])->name('admin.news.pending');
    Route::post('/admin/rejected-news-posts/{id}', [AdminDashboardController::class, 'reject'])->name('admin.news.reject');
    Route::post('/admin/approve-news-posts/{id}', [AdminDashboardController::class, 'approve'])->name('admin.news.approve');
    Route::get('/admin/post', [AdminDashboardController::class, 'post'])->name('admin.news.post');


    Route::get('/admin/news', [NewsPostController::class, 'index'])->name('admin.news.index');
    Route::get('/admin/news/{news}/edit', [NewsPostController::class, 'edit'])->name('admin.news.edit');

    Route::get('/admin/news/{news}/update', [NewsPostController::class, 'update'])->name('admin.news.update');
    Route::put('/admin/news/{news}', [NewsPostController::class, 'update'])->name('admin.news.update');


    Route::delete('/admin/news/{news}', [NewsPostController::class, 'destroy'])->name('admin.news.destroy');

    Route::get('/admin/news/{id}/edit', [NewsPostController::class, 'edit'])->name('admin.news.edit');
    Route::post('/admin/news', [NewsPostController::class, 'store'])->name('admin.news.store');

    Route::post('/ad-and-video', [AdAndVideoController::class, 'store'])->name('store_ad_and_video');
    Route::get('/ad-and-video', [AdAndVideoController::class, 'index'])->name('show_ad_and_video');
    Route::get('/admin/news/adlivmanage', [AdAndVideoController::class, 'adlive'])->name('news.adlivmanage');
    Route::get('/adlive/{id}',[AdAndVideoController::class, 'show'])->name('adlive.show');
    Route::get('/adlive/{id}/edit', [AdAndVideoController::class, 'edit'])->name('adlive.edit');
    Route::put('/adandvideo/{id}', [AdAndVideoController::class, 'update'])->name('adandvideo.update');
    Route::delete('/adlive/{id}', [AdAndVideoController::class, 'destroy'])->name('adlive.destroy');
    Route::delete('/adandvideo/{id}', [AdAndVideoController::class,'destroy'])->name('adandvideo.destroy');

    Route::post('/short_videos', [ShortVideoController::class, 'store'])->name('short_videos.store');
    Route::get('/manage-video', [ShortVideoController::class, 'index'])->name('short_video.index');
    Route::get('/show-all-video', [ShortVideoController::class, 'showAllVideo'])->name('short_video.show-all-videos');

    Route::post('/videos/{id}/like', [ShortVideoController::class, 'like'])->name('short_video.like');
    Route::post('/videos/{id}/view', [ShortVideoController::class, 'view'])->name('short_video.view');
    Route::get('/videos/search', [ShortVideoController::class, 'search'])->name('short_video.search');


    Route::get('/manage-video/{id}', [ShortVideoController::class, 'show'])->name('short_video.show');
    Route::get('/manage-video/{id}/edit', [ShortVideoController::class, 'edit'])->name('short_video.edit');
    Route::delete('/manage-video/{id}', [ShortVideoController::class,'destroy'])->name('short_video.destroy');

    Route::get('/admin/graph', [NewsPostController::class, 'showUserPostGraph'])->name('admin.news.usergraph');


});


