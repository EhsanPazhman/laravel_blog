<?php

namespace App\Http\Controllers\Home;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
        public function index()
    {
        $categories = Category::all();
        $posts = Post::all();
        return view('frontend.index', compact(['categories', 'posts']));
    }
}
