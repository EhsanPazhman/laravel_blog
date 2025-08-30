<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        if (!auth::check()) {
            return redirect('login');
        }
        if (auth::user()->role !== 'admin') {
            abort(403, 'Access denied!');
        }
        $categories = Category::all();
        $posts = Post::all();
        return view('frontend.admin.index', compact(['categories', 'posts']));
    }
}
