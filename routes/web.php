<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\PostsController;
use App\Http\Controllers\Admin\CommentsController;
use App\Http\Controllers\Admin\CategoriesController;

Route::get('/', [HomeController::class, 'index'])->name('/');
Route::prefix('post')->group(function () {
    Route::get('/{slug}', [PostsController::class, 'show'])->name('post.show');
    Route::post('/comment/{post_id}', [CommentsController::class, 'store'])->name('post.comment');
});
Route::prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::resource('categories', CategoriesController::class)->except(['show']);
    Route::resource('posts', PostsController::class)->except(['show']);
});

Route::controller(AuthController::class)->group(function () {
    Route::get('/register', 'registerForm')->name('register.form');
    Route::post('/register', 'register')->name('register');
    Route::get('/login', 'loginForm')->name('login.form');
    Route::post('/login', 'login')->name('login');
    Route::post('/logout', 'logout')->name('logout');
});
