<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CasesPercentageController extends Controller
{
    public function index()
    {
        try {
            $result = DB::table('cases')
                ->selectRaw("
                    COUNT(CASE WHEN DATE(date_created) = CURDATE() AND status = 'active' THEN 1 END) AS active_today_count,
                    COUNT(CASE WHEN DATE(date_created) = CURDATE() - INTERVAL 1 DAY AND status = 'active' THEN 1 END) AS active_yesterday_count,

                    COUNT(CASE WHEN DATE(date_created) = CURDATE() AND status = 'pending' THEN 1 END) AS pending_today_count,
                    COUNT(CASE WHEN DATE(date_created) = CURDATE() - INTERVAL 1 DAY AND status = 'pending' THEN 1 END) AS pending_yesterday_count,

                    COUNT(CASE WHEN DATE(date_created) = CURDATE() AND status = 'completed' THEN 1 END) AS completed_today_count,
                    COUNT(CASE WHEN DATE(date_created) = CURDATE() - INTERVAL 1 DAY AND status = 'completed' THEN 1 END) AS completed_yesterday_count,

                    COUNT(CASE WHEN DATE(date_created) = CURDATE() AND status = 'rejected' THEN 1 END) AS rejected_today_count,
                    COUNT(CASE WHEN DATE(date_created) = CURDATE() - INTERVAL 1 DAY AND status = 'rejected' THEN 1 END) AS rejected_yesterday_count
                ")
                ->first();

            $response = [
                'status' => 'success',
                'active' => [
                    'today_count' => $result->active_today_count,
                    'yesterday_count' => $result->active_yesterday_count,
                    'percentage_change' => $this->calculateChange($result->active_today_count, $result->active_yesterday_count)
                ],
                'pending' => [
                    'today_count' => $result->pending_today_count,
                    'yesterday_count' => $result->pending_yesterday_count,
                    'percentage_change' => $this->calculateChange($result->pending_today_count, $result->pending_yesterday_count)
                ],
                'completed' => [
                    'today_count' => $result->completed_today_count,
                    'yesterday_count' => $result->completed_yesterday_count,
                    'percentage_change' => $this->calculateChange($result->completed_today_count, $result->completed_yesterday_count)
                ],
                'rejected' => [
                    'today_count' => $result->rejected_today_count,
                    'yesterday_count' => $result->rejected_yesterday_count,
                    'percentage_change' => $this->calculateChange($result->rejected_today_count, $result->rejected_yesterday_count)
                ],
            ];

            return response()->json($response);

        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }

    private function calculateChange($today, $yesterday)
    {
        if ((int)$yesterday === 0) {
            return 100.00;
        }

        return round((($today - $yesterday) / $yesterday) * 100, 2);
    }
}
