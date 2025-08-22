<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('frontend.index');
});
Route::get('/dashboard', function () {
    return view('frontend.admin.index');
});
Route::get('/register', function () {
    return view('frontend.layouts.register');
});
Route::get('/login', function () {
    return view('frontend.layouts.login');
});
