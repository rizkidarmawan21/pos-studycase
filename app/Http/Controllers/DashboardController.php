<?php

namespace App\Http\Controllers;

use App\Http\Resources\Dashboard\MostSalesProductListResource;
use App\Models\Transaction;
use App\Services\DashboardService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function __construct(DashboardService $dashboardService)
    {
        $this->dashboardService = $dashboardService;
    }

    public function index()
    {
        $revenueData = Transaction::query()
            ->selectRaw('SUM(grand_total) as total, YEAR(created_at) as year, MONTH(created_at) as month')->groupBy('year', 'month')
            // ->where('created_at', '>=', DB::raw('DATE_SUB(NOW(), INTERVAL 12 MONTH)'))
            ->whereYear('created_at', date('Y'))
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc');


        // $revenueData->when(request('start_date', false) && request('end_date', false), function ($q) use ($start_date, $end_date) {
        //     $q->whereBetween('created_at', [$start_date, $end_date]);
        // });


        $revenueGraphData = [];
        for ($i = 1; $i <= 12; $i++) {
            foreach ($revenueData->get() as $data) {
                if (isset($revenueGraphData[$data->year . '-' . $i])) {
                    if ($i == $data->month) {
                        $revenueGraphData[$data->year . '-' . $i] += (int) $data->total;
                    }
                } else {
                    $revenueGraphData[$data->year . '-' . $i] = $i == $data->month ? (int) $data->total : 0;
                }
            }
        }



        return Inertia::render('admin/dashboard/index', [
            "title" => 'POS | Dashboard',
            "additional" => [
                "graph_data" => $revenueGraphData
            ]
        ]);
    }

    public function get_total_revenue(Request $request)
    {
        try {
            $data = $this->dashboardService->total_revenue($request);
            return $this->respond($data);
        } catch (\Exception $e) {
            return $this->exceptionError($e->getMessage());
        }
    }

    public function get_total_products(Request $request)
    {
        try {
            $data = $this->dashboardService->get_total_products($request);
            return $this->respond($data);
        } catch (\Exception $e) {
            return $this->exceptionError($e->getMessage());
        }
    }

    public function most_sales_product(Request $request)
    {
        try {
            $data = $this->dashboardService->most_sales_product($request);
            $request = new MostSalesProductListResource($data);
            return $this->respond($request);
        } catch (\Exception $e) {
            return $this->exceptionError($e->getMessage());
        }
    }
}
