<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Clients;

class FetchClientsController extends Controller
{
    public function index()
    {
        try {
            $clients = Clients::all();
            return response()->json([
                'status' => 'success',
                'users' => $clients
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
