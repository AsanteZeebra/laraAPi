<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Clients;
use App\Models\Cases;
use App\Models\Passports;

class AddClientController extends Controller
{
    public function addClient(Request $request)
    {
        $validated = $request->validate([
            'fullname' => 'required|string',
            'passport_no' => 'required|string',
            'email' => 'required|email',
            'telephone' => 'required|string',
            'country_of_interest' => 'required|string',
            'application_type' => 'required|string',
            'nationality' => 'nullable|string',
            'issue_date' => 'nullable|date',
            'expiry_date' => 'nullable|date',
        ]);

        // Check for existing client
        $exists = Clients::where('email', $validated['email'])
            ->orWhere('passport_no', $validated['passport_no'])
            ->orWhere('telephone', $validated['telephone'])
            ->exists();

        if ($exists) {
            return response()->json(['status' => 'error', 'message' => 'Customer already exists'], 409);
        }

        // Check for existing case
        $caseExists = Cases::where('passport_no', $validated['passport_no'])
            ->where('country', $validated['country_of_interest'])
            ->exists();

        if ($caseExists) {
            return response()->json(['status' => 'error', 'message' => 'Case already exists for this passport and destination'], 409);
        }

        // Generate IDs
        $month_year = date('Ym');
        $user_id = strtoupper('CL' . $month_year . Str::random(8));
        $case_id = strtoupper('CA' . $month_year . Str::random(8));

        // Create client
        $client = Clients::create([
            'client_id' => $user_id,
            'fullname' => $validated['fullname'],
            'passport_no' => $validated['passport_no'],
            'nationality' => $validated['nationality'] ?? '',
            'issue_date' => $validated['issue_date'] ?? null,
            'expiry_date' => $validated['expiry_date'] ?? null,
            'email' => $validated['email'],
            'telephone' => $validated['telephone'],
            'country_of_interest' => $validated['country_of_interest'],
            'application_type' => $validated['application_type'],
            'year' => date('Y'),
            'status' => 'Active',
        ]);

        // Create case
        $case = Cases::create([
            'case_id' => $case_id,
            'customer_name' => $validated['fullname'],
            'passport_no' => $validated['passport_no'],
            'country' => $validated['country_of_interest'],
            'application_type' => $validated['application_type'],
            'tittle' => 'Case File Created',
            'message' => "Case file created for {$validated['fullname']} with passport number {$validated['passport_no']} for destination {$validated['country_of_interest']}.",
            'status' => 'Active',
        ]);

        // Create passport
        Passports::create([
            'client_id' => $user_id,
            'fullname' => $validated['fullname'],
            'passport_no' => $validated['passport_no'],
            'nationality' => $validated['nationality'] ?? '',
            'issue_date' => $validated['issue_date'] ?? null,
            'expiry_date' => $validated['expiry_date'] ?? null,
            'email' => $validated['email'],
            'status' => 'Active',
        ]);

        return response()->json(['status' => 'success', 'message' => 'Customer added successfully']);
    }

    public function destroy($id)
{
    $client = Clients::find($id);
    if (!$client) {
        return response()->json(['message' => 'Client not found'], 404);
    }
    $client->delete();
    return response()->json(['message' => 'Client deleted successfully']);
}

}
