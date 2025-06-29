<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FetchUsers extends Controller
{
     public function fetcusers()
    {
        try {
            $users = DB::table('users')->get();

            return response()->json([
                'status' => 'success',
                'users' => $users
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function fetch_user_by_id(Request $request)
    {
        $request->validate([
            'uid' => 'required|string',
        ]);

        try {
            $user = DB::table('users')->where('uid', $request->id)->first();

            if ($user) {
                return response()->json([
                    'status' => 'success',
                    'user' => $user
                ]);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'User not found'
                ], 404);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
