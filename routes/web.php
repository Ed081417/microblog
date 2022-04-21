<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

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

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';

Route::get('home', function () {
    return view('home');
})->middleware(['auth', 'verified'])->name('home');

Route::get('home', [PostController::class, 'index'])->middleware(['auth', 'verified'])->name('viewposts');

Route::get('userposts', [PostController::class, 'view'])->middleware(['auth', 'verified'])->name('user-posts');

Route::get('post/{id}/view', [PostController::class, 'show'])->name('view-post');
Route::post('posts', [PostController::class, 'store'])->name('posts');
Route::get('post/{id}/edit', [PostController::class, 'edit'])->name('edit-post');
Route::put('post/{id}', [PostController::class, 'update'])->name('update-post');
Route::post('delete-post', [PostController::class, 'destroy'])->name('delete-post');

