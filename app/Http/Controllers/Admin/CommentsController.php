<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Comments\StoreRequest;
use App\Http\Requests\Admin\Comments\UpdateRequest;

class CommentsController extends Controller
{
    public function index()
    {
        $comments = Comment::all();
        return view('frontend.admin.comments.all', compact(['comments']));
    }
    public function store(StoreRequest $request, $post_id)
    {
        $admin = User::where('role', 'admin')->first();
        $valdatedData = $request->validated();
        $createdComment = Comment::create([
            'comment' => $valdatedData['comment'],
            'user_id' => $admin->id,
            'post_id' => $post_id
        ]);
        if (!$createdComment) {
            return back()->with('failed', 'Comment add hasbeen failed!');
        }
        return back()->with('success', 'Comment added successfully.');
    }
    public function edit($comment_id)
    {
        $comment = Comment::find($comment_id);
        return view('frontend.admin.comments.edit-comment',compact('comment'));
   }
   public function update(UpdateRequest $request, $comment_id)
   {
       $comment = Comment::find($comment_id);
       $valdatedData = $request->validated();
       $comment->update(
        [
            'comment' => $valdatedData['comment']
        ]
       );
       if (!$comment) {
        return back()->with('failed', 'Comment does not updated!');
       }
       return back()->with('success', 'Comment updated successfully.');
   }
    public function destroy($comment_id)
    {
        $post = Comment::find($comment_id);
        $post->delete();
        return back()->with('success', 'Comment deleted!');
    }
}
