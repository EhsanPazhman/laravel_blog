<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Posts\UpdateRequest;
use App\Http\Requests\Admin\Posts\StoreRequest;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class PostsController extends Controller
{
    public function show($slug)
    {
        $categories = Category::all();
        $post = Post::where('slug', $slug)->with('category')->firstOrFail();
        $comments = Comment::with('user')->where('post_id', $post->id)->get();
        return view('frontend.admin.posts.show', compact(['categories', 'post', 'comments']));
    }
    public function create()
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
        $createdPost = Post::create([
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
    public function edit($post_id)
    {
        $categories = Category::all();
        $post = Post::find($post_id);
        return view('frontend.admin.posts.edit-post', compact('post', 'categories'));
    }
    public function update(UpdateRequest $request, $post_id)
    {
        $post = Post::find($post_id);
        $validatedData = $request->validated();
        if ($request->hasFile('image')) {
            if ($post->image && Storage::disk('public_storage')->exists($post->image)) {
                Storage::disk('public_storage')->delete($post->image);
            }
            $path = 'images/' . $validatedData['image']->getClientOriginalName();
            Storage::disk('public_storage')->put($path, File::get($validatedData['image']));
            $validatedData['image'] = $path;
        }
        $updated = $post->update($validatedData);
        if (!$updated) {
            return back()->with('faield', 'Post Not Updated!');
        }
        return back()->with('success', 'Post  Updated Successfully.');
    }
    public function destroy($post_id)
    {
        $post = Post::find($post_id);
        if ($post->image && Storage::disk('public_storage')->exists($post->image)) {
            Storage::disk('public_storage')->delete($post->image);
        }
        $post->delete();
        return back()->with('success', 'Post deleted!');
    }
}
