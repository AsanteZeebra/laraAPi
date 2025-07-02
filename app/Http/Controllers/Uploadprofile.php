<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\User;


class Uploadprofile extends Controller
{
      public function upload(Request $request)
    {
        // Validate request
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'profile_photo' => 'required|image|mimes:jpg,jpeg,png,gif|max:5120', // 5MB
        ]);

        $user = User::find($request->user_id);

        // Store the uploaded file in 'public/profile_photos'
        $path = $request->file('profile_photo')->store('profile_photos', 'public');

        // Update user's photo path
        $user->photo = $path;
        $user->save();

        return response()->json([
            'success' => 'Profile photo uploaded successfully',
            'photo_url' => asset('storage/' . $path),
        ]);
    }
}
