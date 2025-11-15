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
    /**
     * Display the admin dashboard or a specific admin sub-page.
     *
     * This method acts as a central router for the admin panel.
     * The URL `/admin/{page}` (where `{page}` is optional) determines
     * which section is shown (e.g., 'comments', 'posts', 'categories', etc.).
     *
     * @param string $page The requested admin sub-page (default: 'dashboard')
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function dashboard($page = 'dashboard')
    {
        // -----------------------------------------------------------------
        // 1. Authentication & Authorization Check
        // -----------------------------------------------------------------
        // Ensure the user is logged in
        if (!Auth::check()) {
            return redirect('login');
        }

        // Restrict access to admin users only
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Access denied! Only admins can access this page.');
        }

        // -----------------------------------------------------------------
        // 2. Base Data (Shared Across All Admin Pages)
        // -----------------------------------------------------------------
        // These collections can be used for stats, dropdowns, or sidebar
        $categories = Category::all();   // All categories
        $posts      = Post::all();       // All posts
        $comments   = Comment::all();    // All comments
        $users      = User::all();       // All users

        // -----------------------------------------------------------------
        // 3. Page-Specific Paginated Data
        // -----------------------------------------------------------------
        // Dynamically load paginated data based on the requested $page
        $data = [
            'page'       => $page,
            'categories' => $categories,
            'posts'      => $posts,
            'comments'   => $comments,
            'users'      => $users,
        ];

        switch ($page) {
            case 'comments':
                // Fetch only top-level comments (parent_id = null)
                // Eager load user and post relationships
                // Order by latest first, 20 per page using simple pagination
                $data['AllComments'] = Comment::with(['user', 'post'])
                    ->latest()
                    ->simplePaginate(20);
                break;

            case 'posts':
                // Paginated list of posts including their category
                $data['AllPosts'] = Post::with('category')
                    ->latest()
                    ->simplePaginate(20);
                break;

            case 'categories':
                // Paginated list of categories (usually few, but keep pagination for consistency)
                $data['AllCategories'] = Category::latest()
                    ->simplePaginate(20);
                break;

            case 'users':
                // Paginated list of users
                $data['AllUsers'] = User::latest()
                    ->simplePaginate(20);
                break;

            // Add more cases if additional admin pages are implemented
            default:
                // For dashboard home or unknown pages, no extra data is needed
                break;
        }

        // -----------------------------------------------------------------
        // 4. Return the Main Admin Layout View
        // -----------------------------------------------------------------
        // The main view 'frontend.admin.index' uses @include() to load
        // the correct sub-view based on $page (e.g., 'frontend.admin.comments.all')
        // All variables in $data are available in the included sub-views
        return view('frontend.admin.index', $data);
    }
}
