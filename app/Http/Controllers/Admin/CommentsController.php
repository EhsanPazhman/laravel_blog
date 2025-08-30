<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Comments\StoreRequest;

class CommentsController extends Controller
{
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
}
