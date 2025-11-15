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
    /**
     * Toggle like/unlike for a post by authenticated user.
     */
    public function toggleLike(Request $request, Post $post)
    {
        $user = $request->user();
        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        // Check if the user already liked the post
        $existing = $post->likes()->where('user_id', $user->id)->first();
        if ($existing) {
            $existing->delete();
            $liked = false;
        } else {
            $post->likes()->create(['user_id' => $user->id]);
            $liked = true;
        }

        // Return updated like count and status
        $likesCount = $post->likes()->count();
        return response()->json([
            'liked' => $liked,
            'likes_count' => $likesCount,
        ]);
    }

    /**
     * Display top 5 trending posts based on likes count.
     */
    public function trending()
    {
        $posts = Post::withCount('likes')->orderByDesc('likes_count')->take(5)->get();
        return view('frontend.partials.trending', compact('posts'));
    }

    /**
     * Filter posts by category with pagination.
     */
    public function filter($categorySlug = null)
    {
        $categories = Category::all();

        // Use paginate to limit number of posts per page
        $posts = Post::when($categorySlug, function ($query, $slug) {
            return $query->whereHas('category', function ($q) use ($slug) {
                $q->where('slug', $slug);
            });
        })->latest()->simplePaginate(20); // 20 posts per page

        return view('frontend.index', compact('posts', 'categories', 'categorySlug'));
    }

    /**
     * Live search posts by title.
     */
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

    /**
     * Display posts by a given tag with pagination.
     */
    public function byTag($name)
    {
        $categories = Category::all();
        $tag = Tag::where('name', $name)->firstOrFail();

        // Use pagination to avoid loading all posts for this tag
        $posts = $tag->posts()->latest()->simplePaginate(20);
        return view('frontend.index', compact('posts', 'categories'));
    }

    /**
     * Display single post with its comments.
     * Comments are currently not paginated here.
     * We'll handle comment pagination in PostController@show next if needed.
     */
    public function show($slug)
    {
        $categories = Category::all();
        $post = Post::where('slug', $slug)->with('category')->firstOrFail();

        // Only top-level approved comments, paginated
        $comments = Comment::with('user')
            ->where('post_id', $post->id)
            ->where('parent_id', null)
            ->where('status', 'approved')
            ->latest()
            ->simplePaginate(10); // 10 comments per page

        return view('frontend.admin.posts.show', compact(['categories', 'post', 'comments']));
    }

    /**
     * Show form to create a new post.
     */
    public function create()
    {
        $categories = Category::all();
        return view('frontend.admin.posts.add-post', compact('categories'));
    }

    /**
     * Store a newly created post in storage.
     */
    public function store(StoreRequest $request)
    {
        $validatedData = $request->validated();
        $admin = User::where('role', 'admin')->first();

        // Handle image upload
        $path = 'images/' . $validatedData['image']->getClientOriginalName();
        Storage::disk('public_storage')->put($path, File::get($validatedData['image']));

        // Create the post
        $createdPost = Post::create([
            'title' => $validatedData['title'],
            'content' => $validatedData['content'],
            'user_id' => $admin->id,
            'category_id' => $validatedData['category_id'],
            'image' => $path,
        ]);

        if (!$createdPost) {
            return back()->with('failed', 'Cannot create post!');
        }

        // Handle tags
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

    /**
     * Show form to edit a post.
     */
    public function edit($post_id)
    {
        $categories = Category::all();
        $post = Post::findOrFail($post_id); // fail if not found
        return view('frontend.admin.posts.edit-post', compact('post', 'categories'));
    }

    /**
     * Update a post in storage.
     */
    public function update(UpdateRequest $request, $post_id)
    {
        $post = Post::findOrFail($post_id); // fail if not found
        $validatedData = $request->validated();

        // Handle image replacement
        if ($request->hasFile('image')) {
            if ($post->image && Storage::disk('public_storage')->exists($post->image)) {
                Storage::disk('public_storage')->delete($post->image);
            }
            $path = 'images/' . $validatedData['image']->getClientOriginalName();
            Storage::disk('public_storage')->put($path, File::get($validatedData['image']));
            $validatedData['image'] = $path;
        }

        $updated = $post->update($validatedData);

        // Handle tags
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

    /**
     * Delete a post and its related image/tags.
     */
    public function destroy($post_id)
    {
        $post = Post::findOrFail($post_id);

        // Delete image if exists
        if ($post->image && Storage::disk('public_storage')->exists($post->image)) {
            Storage::disk('public_storage')->delete($post->image);
        }

        // Detach all tags
        $post->tags()->detach();

        // Delete the post
        $post->delete();

        return back()->with('success', 'Post deleted successfully!');
    }
}
