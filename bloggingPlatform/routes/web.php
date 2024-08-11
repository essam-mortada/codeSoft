<?php

use App\Http\Controllers\commentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login');
})->name('welcome');
Route::group(['middleware' => 'auth'],function () {
    Route::get('/home', 'App\Http\Controllers\userController@showHome')->name('home');
// Catch-all route for undefined routes
Route::fallback(function () {
    return response()->view('not-found', [], 404);
});

    Route::post('/logout', 'App\Http\Controllers\userController@logout')->name('logout');

    Route::get('/community', 'App\Http\Controllers\userController@showCommunity')->name('community');

/////////////////////////////////////////////////////////////////////////////////////////////////
// authorized user
/////////////////////////////////////////////////////////////////////////////////////////////////
Route::get('/profile/show/{user}', [UserController::class, 'show'])->name('users.show');
Route::get('/profile/{user}/edit', [userController::class, 'edit'])->name('users.edit');
Route::put('/profile/{user}', [userController::class, 'update'])->name('users.update');
Route::get('/change-password/profile/{user}', [UserController::class, 'showChangePasswordForm'])->name('password.change.form');
Route::post('/change-password/{user}', [UserController::class, 'changePassword'])->name('password.change');


//posts

Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');

Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update');

Route::post('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
Route::post('posts/{postId}/upvote', [PostController::class, 'upvote'])->name('posts.upvote');
Route::post('posts/{postId}/downvote', [PostController::class, 'downvote'])->name('posts.downvote');
Route::get('/posts/show/{post}', [PostController::class, 'show'])->name('posts.show');

Route::get('/posts/search', [PostController::class, 'search'])->name('posts.search');


//comments

Route::post('/comment', [commentController::class, 'store'])->name('comment.store');
Route::post('/comment/{comment}', [commentController::class, 'destroy'])->name('comment.destroy');
Route::get('/comment/{comment}/edit', [commentController::class, 'edit'])->name('comment.edit');
Route::put('/comment/{comment}', [commentController::class, 'update'])->name('comment.update');


////////////////////////////////////////////////////////////////////////////////////////////////////

});


Route::get('/register', 'App\Http\Controllers\userController@showRegistrationForm')->name('register');
Route::post('/register', 'App\Http\Controllers\userController@register');

Route::get('/login', 'App\Http\Controllers\userController@showLoginForm')->name('login');
Route::post('/login', 'App\Http\Controllers\userController@login');

