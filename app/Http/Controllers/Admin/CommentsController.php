<?php

namespace App\Http\Controllers\Admin;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class CommentsController extends Controller
{
    /**
     * Store a new comment from the frontend.
     */
    public function store(Request $request, $post_id)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('failed', 'Please login to comment.');
        }

        $request->validate([
            'comment' => 'required|string|max:5000',
            'parent_id' => 'nullable|exists:comments,id'
        ]);

        Comment::create([
            'comment' => $request->comment,
            'user_id' => Auth::id(),
            'post_id' => $post_id,
            'parent_id' => $request->parent_id,
            'status'  => 'pending'
        ]);

        return back()->with('success', 'Your comment is submitted and waiting for approval.');
    }

    /**
     * Update the status of a comment (approve/reject/pending)
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:approved,rejected,pending'
        ]);

        $comment = Comment::findOrFail($id);

        $data = ['status' => $request->status];

        if ($request->status === 'approved') {
            $data['approved_by'] = Auth::id();
            $data['approved_at'] = now();
        } else {
            $data['approved_by'] = null;
            $data['approved_at'] = null;
        }

        $comment->update($data);

        return back()->with('success', 'Comment status updated.');
    }

    /**
     * Show the form to edit a comment
     */
    public function edit($id)
    {
        $comment = Comment::findOrFail($id);
        return view('frontend.admin.comments.edit-comment', compact('comment'));
    }

    /**
     * Update a comment
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'comment' => 'required|string|max:5000'
        ]);

        $comment = Comment::findOrFail($id);
        $comment->update(['comment' => $request->comment]);

        return back()->with('success', 'Comment updated successfully.');
    }

    /**
     * Delete a comment
     */
    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();

        return back()->with('success', 'Comment deleted!');
    }
}
