<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Posts\StoreRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class PostsController extends Controller
{
    public function add()
    {
        $categories = Category::all();
        return view('frontend.admin.posts.add-post', compact('categories'));
    }
    public function store(StoreRequest $request)
    {
        $validatedData = $request->validated();
        $admin = User::where('role', 'admin')->first();
        $path = 'images/' . $validatedData['image']->getClientOriginalName();
         Storage::disk('public_storage')->put($path, File::get($validatedData['image']));
        $createdPost = Post::crgeate([
            'title' => $validatedData['title'],
            'content' => $validatedData['content'],
            'user_id' => $admin->id,
            'category_id' => $validatedData['category_id'],
            'image' => $path,
        ]);
        if (!$createdPost) {
            return back()->with('failed', 'Can not create post!');
        }
        return back()->with('success', 'Post created successfully.');
    }
}
