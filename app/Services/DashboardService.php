<?php

namespace App\Services;

use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;

class DashboardService
{

    public function total_revenue($request)
    {
        $start_date = $request->start_date;
        $end_date = $request->end_date;

        if ($start_date && $end_date) {
            $total_revenue = Transaction::whereBetween('created_at', [$start_date, $end_date]);
            $revenueData = Transaction::query()
                ->selectRaw('SUM(grand_total) as total, DATE(created_at) as date')->groupBy('date')
                ->whereBetween('created_at', [$start_date, $end_date]);

            $revenueGraphData = [];
            for ($i = strtotime($start_date); $i <= strtotime($end_date); $i += 86400) {
                foreach ($revenueData->get() as $data) {
                    if (isset($revenueGraphData[date('Y-m-d', $i)])) {
                        if (date('Y-m-d', $i) == $data->date) {
                            $revenueGraphData[date('Y-m-d', $i)] += (int) $data->total;
                        }
                    } else {
                        $revenueGraphData[date('Y-m-d', $i)] = date('Y-m-d', $i) == $data->date ? (int) $data->total : 0;
                    }
                }
            }
        } else {
            $total_revenue = Transaction::whereYear('created_at', date('Y'));
            $revenueData = Transaction::query()
                ->selectRaw('SUM(grand_total) as total, YEAR(created_at) as year, MONTH(created_at) as month')->groupBy('year', 'month')
                ->whereYear('created_at', date('Y'))
                ->orderBy('year', 'asc')
                ->orderBy('month', 'asc');

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

        if ($start_date && $end_date) {
            $query = Transaction::whereBetween('created_at', [$start_date, $end_date]);

            $graph_total_transaction = Transaction::query()
                ->selectRaw('COUNT(*) as total, DATE(created_at) as date')->groupBy('date')
                ->whereBetween('created_at', [$start_date, $end_date]);

            $graphData = [];
            for ($i = strtotime($start_date); $i <= strtotime($end_date); $i += 86400) {
                foreach ($graph_total_transaction->get() as $data) {
                    if (isset($graphData[date('Y-m-d', $i)])) {
                        if (date('Y-m-d', $i) == $data->date) {
                            $graphData[date('Y-m-d', $i)] += (int) $data->total;
                        }
                    } else {
                        $graphData[date('Y-m-d', $i)] = date('Y-m-d', $i) == $data->date ? (int) $data->total : 0;
                    }
                }
            }
        }else{
            $query = Transaction::whereYear('created_at', date('Y'));

            $graph_total_transaction = Transaction::query()
                ->selectRaw('COUNT(*) as total, YEAR(created_at) as year, MONTH(created_at) as month')->groupBy('year', 'month')
                ->whereYear('created_at', date('Y'))
                ->orderBy('year', 'asc')
                ->orderBy('month', 'asc');

            $graphData = [];
            for ($i = 1; $i <= 12; $i++) {
                foreach ($graph_total_transaction->get() as $data) {
                    if (isset($graphData[$data->year . '-' . $i])) {
                        if ($i == $data->month) {
                            $graphData[$data->year . '-' . $i] += (int) $data->total;
                        }
                    } else {
                        $graphData[$data->year . '-' . $i] = $i == $data->month ? (int) $data->total : 0;
                    }
                }
            }
        }

        return [
            'total' => $query->count(),
            'graph_data' => $graphData
        ];
    }

    public function get_total_products($request)
    {
        $start_date = $request->start_date;
        $end_date = $request->end_date;

        $query = Product::query();

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
            $q->whereBetween('products.created_at', [$start_date, $end_date]);
        });

        return $query->get();
    }
}
