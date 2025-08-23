<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoriesController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->group(function () {
    Route::get('', [AdminController::class, 'index']);
    Route::prefix('categories')->group(function () {
        Route::get('', [CategoriesController::class, 'all']);
        Route::get('add', [CategoriesController::class, 'add']);
        Route::post('store', [CategoriesController::class, 'store']);
        Route::delete('{category_id}/delete', [CategoriesController::class, 'delete']);
        Route::get('{category_id}/edit', [CategoriesController::class, 'edit']);
        Route::put('{category_id}/update', [CategoriesController::class, 'update']);
    });
});
Route::get('/', function () {
    return view('frontend.index');
});
Route::get('/register', function () {
    return view('frontend.layouts.register');
});
Route::get('/login', function () {
    return view('frontend.layouts.login');
});
