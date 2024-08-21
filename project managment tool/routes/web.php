<?php

use App\Http\Controllers\Auth\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();


Route::prefix('admin')->name("admin.")->group(function () {

    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/contact', [HomeController::class, 'contact'])->name('contact');

    Route::get('/profile', [HomeController::class, 'profile'])->name('profile');
    Route::get('/eror404', [HomeController::class, 'eror404'])->name('eror404');
    Route::get('/faq', [HomeController::class, 'faq'])->name('faq');
    Route::put('/profile/{user}', [UserController::class, 'update'])->name('profile.update');
    Route::post('/change-password/{user}', [UserController::class, 'changePassword'])->name('password.change');
});

Route::prefix('projects')->name("projects.")->group(function () {

    Route::get('/index', [ProjectController::class, 'index'])->name('index');
    Route::get('/create', [ProjectController::class, 'create'])->name('create');
    Route::post('/store', [ProjectController::class, 'store'])->name('store');
    Route::get('/show/{project}', [ProjectController::class, 'show'])->name('show');

    Route::get('/edit/{project}', [ProjectController::class, 'edit'])->name('edit');
    Route::post('/update/{project}', [ProjectController::class, 'update'])->name('update');
    Route::post('/destroy/{project}', [ProjectController::class, 'destroy'])->name('destroy');
    Route::post('/update-status/{project}', [ProjectController::class, 'update_status'])->name('update-status');
    Route::post('/download/{project}', [ProjectController::class, 'download_file'])->name('download');

});

Route::prefix('tasks')->name("tasks.")->group(function () {

    Route::get('/index', [TaskController::class, 'index'])->name('index');
    Route::get('/create', [TaskController::class, 'create'])->name('create');
    Route::post('/store', [TaskController::class, 'store'])->name('store');
    Route::get('/show/{task}', [TaskController::class, 'show'])->name('show');

    Route::get('/edit/{task}', [TaskController::class, 'edit'])->name('edit');
    Route::post('/update/{task}', [TaskController::class, 'update'])->name('update');
    Route::post('/destroy/{task}', [TaskController::class, 'destroy'])->name('destroy');
    Route::post('/update-status/{task}', [TaskController::class, 'update_status'])->name('update-status');
    Route::post('/download/{task}', [TaskController::class, 'download_file'])->name('download');
});

Route::prefix('notes')->name("notes.")->group(function () {

    Route::get('/index', [NoteController::class, 'index'])->name('index');
    Route::get('/create', [NoteController::class, 'create'])->name('create');
    Route::post('/store', [NoteController::class, 'store'])->name('store');
    Route::get('/show/{note}', [NoteController::class, 'show'])->name('show');

    Route::get('/edit/{note}', [NoteController::class, 'edit'])->name('edit');
    Route::post('/update/{note}', [NoteController::class, 'update'])->name('update');
    Route::post('/destroy/{note}', [NoteController::class, 'destroy'])->name('destroy');
});
