<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CountCasesController extends Controller
{
    public function index()
    {
        try {
            $allCases = DB::table('cases')->count();
            $activeCases = DB::table('cases')->where('status', 'active')->count();
            $pendingCases = DB::table('cases')->where('status', 'Pending')->count();
            $completeCases = DB::table('cases')->where('status', 'Complete')->count();
            $rejectedCases = DB::table('cases')->where('status', 'Rejected')->count();

            return response()->json([
                'status' => 'success',
                'all_cases' => $allCases,
                'active_cases' => $activeCases,
                'pending_cases' => $pendingCases,
                'complete_cases' => $completeCases,
                'rejected_cases' => $rejectedCases,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
