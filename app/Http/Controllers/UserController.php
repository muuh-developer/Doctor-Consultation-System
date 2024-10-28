<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('users.show', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        // Validate the incoming request
        $request->validate([
            'profile_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        ]);

        // Handle the profile image upload
        if ($request->hasFile('profile_image')) {
            // Delete old profile image if it exists
            if ($user->profile_image) {
                Storage::disk('public')->delete($user->profile_image);
            }

            // Store the new profile image
            $path = $request->file('profile_image')->store('profile_images', 'public');
            $user->profile_image = $path;
        }

        // Update other user fields
        $user->name = $request->input('name');
        $user->email = $request->input('email');

        // Save the updated user details
        $user->save();

        // Redirect to the user profile page with a success message
        return redirect()->route('user.show', $user->id)->with('success', 'Profile updated successfully');
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

}
