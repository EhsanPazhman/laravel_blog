<?php

namespace App\Http\Controllers\Admin;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentsController extends Controller
{
    /**
     * Show all comments (Admin Panel)
     */
    public function index()
    {
        $comments = Comment::with(['user', 'post'])->latest()->get();
        return view('frontend.admin.comments.all', compact('comments'));
    }

    /**
     * Store new comment (Frontend)
     */
    public function store(Request $request, $post_id)
    {
        if (!auth()->check()) {
            return redirect()->route('login')
                ->with('failed', 'Please login to comment.');
        }

        $request->validate([
            'comment' => 'required|string|max:5000',
            'parent_id' => 'nullable|exists:comments,id'
        ]);

        Comment::create([
            'comment' => $request->comment,
            'user_id' => auth()->id(),
            'post_id' => $post_id,
            'parent_id' => $request->parent_id,
            'status'  => 'pending'
        ]);

        return back()->with('success', 'Your comment is submitted and waiting for approval.');
    }

    /**
     * Update status (approve / reject)
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:approved,rejected,pending'
        ]);

        $comment = Comment::findOrFail($id);

        $data = [
            'status' => $request->status
        ];

        if ($request->status === 'approved') {
            $data['approved_by'] = auth()->id();
            $data['approved_at'] = now();
        } else {
            // Reset approval info if rejected/pending
            $data['approved_by'] = null;
            $data['approved_at'] = null;
        }

        $comment->update($data);

        return back()->with('success', 'Comment status updated.');
    }

    /**
     * Edit Form
     */
    public function edit($id)
    {
        $comment = Comment::findOrFail($id);
        return view('frontend.admin.comments.edit-comment', compact('comment'));
    }

    /**
     * Update Comment Text
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'comment' => 'required|string|max:5000'
        ]);

        $comment = Comment::findOrFail($id);

        $comment->update([
            'comment' => $request->comment
        ]);

        return back()->with('success', 'Comment updated successfully.');
    }

    /**
     * Delete Comment
     */
    public function destroy($id)
    {
        Comment::findOrFail($id)->delete();

        return back()->with('success', 'Comment deleted!');
    }
}
