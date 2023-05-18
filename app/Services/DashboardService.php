<?php

namespace App\Services;

use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;

class DashboardService
{

    public function total_revenue($request)
    {
        // // make total revenue query and filter by range date
        $start_date = $request->start_date;
        $end_date = $request->end_date;

        // where this year
        $query = Transaction::whereYear('created_at', date('Y'));

        $total_revenue = $query->when(request('start_date', false) && request('end_date', false), function ($q) use ($start_date, $end_date) {
            $q->whereBetween('created_at', [$start_date, $end_date]);
        });


        $revenueData = Transaction::query()
            ->selectRaw('SUM(grand_total) as total, YEAR(created_at) as year, MONTH(created_at) as month')->groupBy('year', 'month')
            // ->where('created_at', '>=', DB::raw('DATE_SUB(NOW(), INTERVAL 12 MONTH)'))
            ->whereYear('created_at', date('Y'))
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc');


        $revenueData->when(request('start_date', false) && request('end_date', false), function ($q) use ($start_date, $end_date) {
            $q->whereBetween('created_at', [$start_date, $end_date]);
        });


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

        return [
            "total_revenue" => $total_revenue->sum('grand_total'),
            "graph_data" => $revenueGraphData
        ];
    }

    public function get_total_transaction($request)
    {
        $start_date = $request->start_date;
        $end_date = $request->end_date;

        $query = Transaction::whereYear('created_at', date('Y'));

        $query->when(request('start_date', false) && request('end_date', false), function ($q) use ($start_date, $end_date) {
            $q->whereBetween('created_at', [$start_date, $end_date]);
        });

        return [
            'total' => $query->count()
        ];
    }
    public function get_total_products($request)
    {
        $start_date = $request->start_date;
        $end_date = $request->end_date;

        $query = Product::whereYear('created_at', date('Y'));

        $query->when(request('start_date', false) && request('end_date', false), function ($q) use ($start_date, $end_date) {
            $q->whereBetween('created_at', [$start_date, $end_date]);
        });

        return [
            'total' => $query->count()
        ];
    }

    public function most_sales_product($request)
    {
        $start_date = $request->start_date;
        $end_date = $request->end_date;

        $query = Product::query()
            ->Join('transaction_details', 'products.id', '=', 'transaction_details.product->id')
            ->selectRaw('products.*, COALESCE(sum(transaction_details.qty),0) total, COALESCE(sum(transaction_details.price),0) total_price')
            ->groupBy('products.id')
            ->orderBy('total', 'desc')
            ->take(5);

        $query->when(request('start_date', false) && request('end_date', false), function ($q) use ($start_date, $end_date) {
            $q->whereBetween('created_at', [$start_date, $end_date]);
        });

        return $query->get();
    }
}
