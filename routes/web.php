<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PostLikeController;
use App\Http\Controllers\PostCommentController;
use App\Http\Controllers\PostShareController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FollowController;

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

Route::get('/', function () {
    return view('homepage');
});

require __DIR__.'/auth.php';

//Home
Route::get('home', function () { return view('home'); })->middleware(['auth', 'verified'])->name('home');
Route::get('home', [PostController::class, 'index'])->middleware(['auth', 'verified'])->name('viewposts');
Route::get('userposts', [PostController::class, 'view'])->middleware(['auth', 'verified'])->name('user-posts');

//Post
Route::get('post/{id}/view', [PostController::class, 'show'])->name('view-post');
Route::post('posts', [PostController::class, 'store'])->name('posts');
Route::get('post/{id}/edit', [PostController::class, 'edit'])->name('edit-post');
Route::put('post/{id}', [PostController::class, 'update'])->name('update-post');
Route::post('delete-post', [PostController::class, 'destroy'])->name('delete-post');

//Post Like
Route::post('post/{post}/likes', [PostLikeController::class, 'store'])->name('like-post');
Route::delete('post/{post}/likes', [PostLikeController::class, 'destroy'])->name('unlike-post');

//Post Comment
Route::post('post/{post}/comments', [PostCommentController::class, 'store'])->name('comment-post');
Route::get('edit-comment/{id}', [PostCommentController::class, 'edit'])->name('edit-comment');
Route::put('update-comment', [PostCommentController::class, 'update'])->name('update-comment');
Route::post('delete-comment', [PostCommentController::class, 'destroy'])->name('delete-comment');

//Post Share
Route::post('share-post', [PostShareController::class, 'store'])->name('share-post');

//Profile
Route::get('profile', [UserController::class, 'index'])->middleware(['auth', 'verified'])->name('profile');
Route::get('profile/{id}/edit', [UserController::class, 'edit'])->name('edit-profile');
Route::put('profile/{id}', [UserController::class, 'update'])->name('update-profile');
Route::get('user/{id}/profile', [UserController::class, 'show'])->name('view-profile');

//Follow
Route::get('user/profile', [FollowController::class, 'show'])->name('user-profile');
Route::post('follow', [FollowController::class, 'store'])->name('follow');


