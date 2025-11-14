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

    // Store a comment for a specific post (UPDATED)
    Route::post('/{post}/comments', [CommentsController::class, 'store'])
        ->name('post.comment');

    // Show a single post by slug
    Route::get('/{slug}', [PostsController::class, 'show'])->name('post.show');
});

// Admin panel routes
Route::prefix('admin')->name('admin.')->group(function () {

    // Dashboard main page
    Route::get('/{page?}', [AdminController::class, 'dashboard'])->name('dashboard');

    // Settings page
    Route::get('/settings', [AdminController::class, 'dashboard'])->name('settings');

    // Logout from admin panel
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Resource routes for Categories
    Route::resource('categories', CategoriesController::class)->except(['show']);

    // Resource routes for Posts
    Route::resource('posts', PostsController::class)->except(['show']);

    // Resource routes for Comments (CRUD)
    Route::resource('comments', CommentsController::class)->except(['show']);

    // UPDATE status of a comment (NEW)
    Route::patch('comments/{comment}/status', [CommentsController::class, 'updateStatus'])
        ->name('comments.updateStatus');

    // Resource routes for Users
    Route::resource('users', UsersController::class)->except(['show']);
});

// Authentication routes
Route::controller(AuthController::class)->group(function () {

    // Register
    Route::get('/register', 'registerForm')->name('register.form');
    Route::post('/register', 'register')->name('register');

    // Login
    Route::get('/login', 'loginForm')->name('login.form');
    Route::post('/login', 'login')->name('login');

    // Logout (frontend)
    Route::post('/logout', 'logout')->name('logout');
});
