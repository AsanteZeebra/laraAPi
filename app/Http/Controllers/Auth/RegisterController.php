<?php


namespace App\Http\Controllers\Auth;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Str;


class RegisterController extends Controller
{

     public function register(Request $request)
    {
        // Validate request
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required|string|min:6',
            'role' => 'required|string', // Remove invalid 'users' rule
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Generate IDs
        $month_year = date('Ym');
        $user_id = strtoupper('UD' . $month_year . Str::random(4));
        // Create user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role'=> $request->role ?? 'User', // Default role to 'user' if not provided
            'user_id' => $user_id, // Add user_id field

        ]);

        // Create token
        $token = $user->createToken('auth_token')->plainTextToken;

        // Return response
        return response()->json([
            'message' => 'User registered successfully',
            'user' => $user,
            'token' => $token
        ], 201);
    }

}
