<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\PostController;
use App\Http\Controllers\PostLikeController;
use App\Http\Controllers\PostCommentController;
use App\Http\Controllers\PostShareController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\SearchController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Landing Page
Route::get('/', function () {
    return view('homepage');
});

require __DIR__.'/auth.php';

//Home
Route::get('home', function () { return view('home'); })->middleware(['auth', 'verified'])->name('home');
Route::get('home', [PostController::class, 'index'])->middleware(['auth', 'verified'])->name('viewposts');

//Post
Route::get('post/{id}/view', [PostController::class, 'show'])->name('view-post');
Route::get('userposts', [PostController::class, 'view'])->middleware(['auth', 'verified'])->name('user-posts');
Route::post('posts', [PostController::class, 'store'])->name('posts');
Route::get('post/{post}/edit', [PostController::class, 'edit'])->name('edit-post');
Route::put('post/{id}', [PostController::class, 'update'])->name('update-post');
Route::put('remove-image', [PostController::class, 'removeImg'])->name('remove-image');
Route::post('post/{post}/delete', [PostController::class, 'destroy'])->name('delete-post');

//Post Like
Route::post('post/{post}/likes', [PostLikeController::class, 'store'])->name('like-post');
Route::delete('post/{post}/unlikes', [PostLikeController::class, 'destroy'])->name('unlike-post');

//Post Comment
Route::post('post/{post}/comments', [PostCommentController::class, 'store'])->name('comment-post');
Route::get('edit-comment/{id}', [PostCommentController::class, 'edit'])->name('edit-comment');
Route::put('comment/{comment}/update', [PostCommentController::class, 'update'])->name('update-comment');
Route::post('comment/{comment}/delete', [PostCommentController::class, 'destroy'])->name('delete-comment');

//Post Share
Route::get('shared-posts', [PostShareController::class, 'index'])->name('shared-posts');
Route::post('share-post', [PostShareController::class, 'store'])->name('share-post');
Route::get('user/{id}/shared', [PostShareController::class, 'show'])->name('view-shared');
Route::post('share/{sharedpost}/delete', [PostShareController::class, 'destroy'])->name('delete-shared');

//Profile
Route::get('profile', [UserController::class, 'index'])->middleware(['auth', 'verified'])->name('profile');
Route::get('profile/{user}/edit', [UserController::class, 'edit'])->name('edit-profile');
Route::put('profile/{id}', [UserController::class, 'update'])->name('update-profile');
Route::put('remove-profileImg', [UserController::class, 'removeImg'])->name('remove-profileImg');
Route::get('user/{id}/profile', [UserController::class, 'show'])->name('view-profile');
Route::get('change-password', [UserController::class, 'changePassword'])->name('change-password');
Route::put('reset-password', [UserController::class, 'resetPassword'])->name('reset-password');
Route::get('change-email', [UserController::class, 'changeEmail'])->name('change-email');
Route::put('reset-email', [UserController::class, 'resetEmail'])->name('reset-email');

//Follow/Unfollow 
Route::post('profile/{user}/follow', [FollowController::class, 'store'])->name('follow');
Route::post('unfollow', [FollowController::class, 'destroy'])->name('unfollow');
Route::get('profile/{id}/followers', [FollowController::class, 'profileFollowers'])->name('view-followers');
Route::get('profile/{id}/followings', [FollowController::class, 'profileFollowings'])->name('view-followings');

//View Followers/Followings
Route::get('followers', [FollowController::class, 'followerList'])->name('followers');
Route::get('followings', [FollowController::class, 'followingList'])->name('followings');

//Search 
Route::get('findpeople', [SearchController::class, 'index'])->name('find-people');
Route::get('/search/post', [SearchController::class, 'queryPost'])->name('search-post');
Route::get('/search/user', [SearchController::class, 'queryUser'])->name('search-user');


