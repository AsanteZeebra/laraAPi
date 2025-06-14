<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CasesController extends Controller
{
    public function index(Request $request)
    {
        try {
            // Fetch all cases from the 'cases' table
            $cases = DB::table('cases')->get();

            if ($cases->isEmpty()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'No cases found'
                ], 404);
            }

            return response()->json([
                'status' => 'success',
                'cases' => $cases
            ], 200);

        } catch (\Exception $e) {
            Log::error('Cases fetch error: ' . $e->getMessage());

            return response()->json([
                'status' => 'error',
                'message' => 'Connection failed: ' . $e->getMessage()
            ], 500);
        }
    }
}
