<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\PostsController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\CommentsController;
use App\Http\Controllers\Admin\CategoriesController;

// Main homepage route
Route::get('/', [HomeController::class, 'index'])->name('/');

// Frontend post routes
Route::prefix('post')->group(function () {
    // Filter posts by category
    Route::get('/category/{slug?}', [PostsController::class, 'filter']);

    // Filter posts by tags
    Route::get('/tag/{name}', [PostsController::class, 'byTag'])->name('post.byTag');

    // Search posts
    Route::get('/search', [PostsController::class, 'search'])->name('post.search');

    // Like / Unlike a post (AJAX)
    Route::post('/{post}/like', [PostsController::class, 'toggleLike'])->name('post.like');

    // Show a single post by slug
    Route::get('/{slug}', [PostsController::class, 'show'])->name('post.show');

    // Store a comment for a specific post
    Route::post('/comment/{post_id}', [CommentsController::class, 'store'])->name('post.comment');
});

// Admin panel routes
Route::prefix('admin')->name('admin.')->group(function () {
    // Dashboard main page (optional page parameter)
    Route::get('/{page?}', [AdminController::class, 'dashboard'])->name('dashboard');

    // Settings page in dashboard
    Route::get('/settings', [AdminController::class, 'dashboard'])->name('settings');

    // Logout from admin panel
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Resource routes for Categories (all CRUD except show)
    Route::resource('categories', CategoriesController::class)->except(['show']);

    // Resource routes for Posts (all CRUD except show)
    Route::resource('posts', PostsController::class)->except(['show']);

    // Resource routes for Comments (all CRUD except show)
    Route::resource('comments', CommentsController::class)->except(['show']);

    // Resource routes for Users (all CRUD except show)
    Route::resource('users', UsersController::class)->except(['show']);
});

// Authentication routes (register, login, logout)
Route::controller(AuthController::class)->group(function () {
    // Show registration form
    Route::get('/register', 'registerForm')->name('register.form');

    // Handle registration form submission
    Route::post('/register', 'register')->name('register');

    // Show login form
    Route::get('/login', 'loginForm')->name('login.form');

    // Handle login form submission
    Route::post('/login', 'login')->name('login');

    // Logout (frontend)
    Route::post('/logout', 'logout')->name('logout');
});
