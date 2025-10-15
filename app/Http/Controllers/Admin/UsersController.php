<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('frontend.admin.users.all', compact(['users']));
    }
    public function destroy($user_id)
    {
        $post = User::find($user_id);
        $post->delete();
        return back()->with('success', 'User deleted!');
    }
}
