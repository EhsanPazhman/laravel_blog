<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\PostsController;
use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\CommentsController;

Route::get('/', [HomeController::class, 'index']);
Route::prefix('post')->group(function () {
    Route::post('/comment/{post_id}', [CommentsController::class, 'store']);
    Route::get('/{slug}', [PostsController::class, 'show']);
});
Route::prefix('admin')->group(function () {
    Route::get('', [AdminController::class, 'index']);
    Route::prefix('categories')->group(function () {
        Route::get('add', [CategoriesController::class, 'add']);
        Route::post('store', [CategoriesController::class, 'store']);
        Route::get('{category_id}/edit', [CategoriesController::class, 'edit']);
        Route::put('{category_id}/update', [CategoriesController::class, 'update']);
        Route::delete('{category_id}/delete', [CategoriesController::class, 'delete']);
    });
    Route::prefix('posts')->group(function () {
        Route::get('add', [PostsController::class, 'add']);
        Route::post('store', [PostsController::class, 'store']);
        Route::get('{post_id}/edit', [PostsController::class, 'edit']);
        Route::put('{post_id}/update', [PostsController::class, 'update']);
        Route::delete('{post_id}/delete', [PostsController::class, 'delete']);
    });
});
Route::get('/register', function () {
    return view('frontend.layouts.register');
});
Route::get('/login', function () {
    return view('frontend.layouts.login');
});
