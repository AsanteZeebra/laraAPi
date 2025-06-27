<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FindCaseController extends Controller
{
     public function findCase(Request $request)
    {
        $request->validate([
            'passport_no' => 'required|string',
        ]);

        $passport_no = trim($request->passport_no);

        $case = DB::table('cases')->where('passport_no', $passport_no)->first();

        if ($case) {
            return response()->json([
                'status' => 'success',
                'case' => $case
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'No case found for this passport'
            ]);
        }
    }

     public function clientinfo(Request $request)
    {
        $request->validate([
            'passport_no' => 'required|string',
        ]);

        $passport_no = trim($request->passport_no);

        $case = DB::table('clients')->where('passport_no', $passport_no)->first();

        if ($case) {
            return response()->json([
                'status' => 'success',
                'case' => $case
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'No case found for this passport'
            ]);
        }
    }


}

