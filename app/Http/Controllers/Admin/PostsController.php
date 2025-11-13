<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tag;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Admin\Posts\StoreRequest;
use App\Http\Requests\Admin\Posts\UpdateRequest;

class PostsController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return view('frontend.admin.posts.all', compact(['posts']));
    }
    public function toggleLike(Request $request, Post $post)
    {
        $user = $request->user();
        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        // try to delete existing like
        $existing = $post->likes()->where('user_id', $user->id)->first();
        if ($existing) {
            $existing->delete();
            $liked = false;
        } else {
            $post->likes()->create(['user_id' => $user->id]);
            $liked = true;
        }

        // return JSON with updated count and state
        $likesCount = $post->likes()->count();

        return response()->json([
            'liked' => $liked,
            'likes_count' => $likesCount,
        ]);
    }

    public function trending()
    {
        // top 5 posts by likes_count
        $posts = Post::withCount('likes')->orderByDesc('likes_count')->take(5)->get();
        return view('frontend.partials.trending', compact('posts'));
    }
    public function filter($categorySlug = null)
    {
        $categories = Category::all();
        $posts = Post::when($categorySlug, function ($query, $slug) {
            return $query->whereHas('category', function ($q) use ($slug) {
                $q->where('slug', $slug);
            });
        })->paginate(10);

        return view('frontend.index', compact('posts', 'categories', 'categorySlug'));
    }

    public function search(Request $request)
    {
        $query = $request->get('search');
        $posts = Post::where('title', 'LIKE', "%{$query}%")->take(5)->get();
        $html = '';
        foreach ($posts as $post) {
            $html .= "<div class='p-2 hover:bg-gray-800 cursor-pointer'>
                    <a href='" . route('post.show', $post->slug) . "' class='block text-gray-200'>
                        {$post->title}
                    </a>
                  </div>";
        }
        return $html ?: "<div class='p-2 text-gray-400'>No results found</div>";
    }
    public function byTag($name)
    {
        $categories = Category::all();
        $tag = Tag::where('name', $name)->firstOrFail();
        $posts = $tag->posts()->latest()->paginate(10);
        return view('frontend.index', compact('posts', 'categories'));
    }

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
        $stopWords = ['and', 'or', 'the', 'a', 'an', 'in', 'on', 'at', 'with', 'for', 'of', 'to', 'by'];
        $tagsInput = $validatedData['tags'] ?? null;

        if (empty($tagsInput)) {
            $tagsArray = explode(' ', mb_strtolower($validatedData['title']));
        } else {
            $tagsArray = explode(',', $tagsInput);
        }

        $finalTags = collect();

        foreach ($tagsArray as $tagName) {
            $tagName = strtolower(trim($tagName));
            $tagName = preg_replace('/[^a-z0-9\-]/', '', $tagName);
            if ($tagName === '' || in_array($tagName, $stopWords)) continue;
            $tag = Tag::firstOrCreate(['name' => $tagName]);
            $finalTags->push($tag->id);
        }

        if ($finalTags->isNotEmpty()) {
            $createdPost->tags()->sync($finalTags->unique()->take(3));
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
        $updated = $post->update($validatedData);

        if ($updated) {
            $tagsInput = $request->input('tags');
            if (empty($tagsInput)) {
                $tagsArray = explode(' ', strtolower($request->title));
            } else {
                $tagsArray = explode(',', $tagsInput);
            }
            $finalTags = collect();
            foreach ($tagsArray as $tagName) {
                $tagName = strtolower(trim($tagName));
                $tagName = preg_replace('/[^a-z0-9\-]/', '', $tagName);
                if ($tagName === '') continue;
                $tag = Tag::firstOrCreate(['name' => $tagName]);
                $finalTags->push($tag->id);
            }
            $post->tags()->sync($finalTags->unique());
        }
        if (!$updated) {
            return back()->with('failed', 'Post Not Updated!');
        }
        return back()->with('success', 'Post Updated Successfully.');
    }
    public function destroy($post_id)
    {
        $post = Post::find($post_id);
        if (!$post) {
            return back()->with('failed', 'Post not found!');
        }
        if ($post->image && Storage::disk('public_storage')->exists($post->image)) {
            Storage::disk('public_storage')->delete($post->image);
        }
        $post->tags()->detach();
        $post->delete();
        return back()->with('success', 'Post deleted successfully!');
    }
}
