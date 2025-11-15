<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Delete a user from the database.
     *
     * @param int $user_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($user_id)
    {
        // Find the user by ID or fail with 404
        $user = User::findOrFail($user_id);

        // Delete the user
        $user->delete();

        // Redirect back with a success message
        return back()->with('success', 'User deleted successfully!');
    }

    /**
     * Show the form to edit a user's details.
     *
     * @param int $user_id
     * @return \Illuminate\View\View
     */
    public function edit($user_id)
    {
        // Find the user by ID or fail
        $user = User::findOrFail($user_id);

        // Pass the user data to the edit view
        return view('frontend.admin.users.edit', compact('user'));
    }

    /**
     * Update a user's details in the database.
     *
     * @param Request $request
     * @param int $user_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $user_id)
    {
        // Find the user by ID or fail
        $user = User::findOrFail($user_id);

        // Validate the incoming request
        $request->validate([
            'name' => 'required|string|max:255',
            // Ensure email is unique except for current user
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required|in:admin,user', // Only allow specific roles
        ]);

        // Update the user with validated fields
        $user->update($request->only('name', 'email', 'role'));

        // Redirect back with a success message
        return back()->with('success', 'User updated successfully!');
    }
}
