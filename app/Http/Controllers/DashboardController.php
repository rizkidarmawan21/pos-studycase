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
        return Inertia::render('admin/dashboard/index', [
            "title" => 'POS | Dashboard',
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

    public function get_total_transaction(Request $request)
    {
        try {
            $data = $this->dashboardService->get_total_transaction($request);
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
