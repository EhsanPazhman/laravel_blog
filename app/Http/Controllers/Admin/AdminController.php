<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboard($page = 'dashboard')
    {
        if (!auth::check()) {
            return redirect('login');
        }
        if (auth::user()->role !== 'admin') {
            abort(403, 'Access denied!');
        }
        $categories = Category::all();
        $posts = Post::all();
        $comments = Comment::all();
        $users = User::all();
        return view('frontend.admin.index', compact(['page','categories', 'posts', 'users', 'comments']));
    }
}
