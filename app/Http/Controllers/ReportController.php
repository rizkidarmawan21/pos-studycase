<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Exports\ReportExport;
use App\Services\ReportService;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Resources\Report\ReportListResource;

class ReportController extends Controller
{
    public function __construct(ReportService $reportService)
    {
        $this->reportService = $reportService;
    }

    public function index()
    {
        return Inertia::render('admin/report/index', [
            "title" => 'POS | Report'
        ]);
    }

    public function getData(Request $request)
    {
        try {
            $data = $this->reportService->getData($request);

            $result = new ReportListResource($data);
            return $this->respond($result);
        } catch (\Exception $e) {
            return $this->exceptionError($e->getMessage());
        }
    }

    public function exportExcelReport(Request $request)
    {
        try {
            $start_date = $request->start_date ?: Carbon::now()->startOfMonth()->format('Y-m-d');
            $end_date = $request->end_date ?: Carbon::now()->endOfMonth()->format('Y-m-d');

            return Excel::download(new ReportExport($start_date, $end_date), 'transactions_' . Carbon::now()->timestamp . '.xlsx');
        } catch (\Exception $e) {
            return $this->exceptionError($e->getMessage());
        }
    }

    public function exportPdfReport(Request $request)
    {
        try {
            $start_date = $request->start_date ?: Carbon::now()->startOfMonth()->format('Y-m-d');
            $end_date = $request->end_date ?: Carbon::now()->endOfMonth()->format('Y-m-d');
            $data = $this->reportService->getPdfData($start_date, $end_date);
        
            $pdf = PDF::loadView('export.transaction', [
                'transactions' => $data['transactions'],
                'total' => $data['total']
            ]);
            return $pdf->download('transactions_' . Carbon::now()->timestamp. '.pdf');
        } catch (\Exception $e) {
            return $this->exceptionError($e->getMessage());
        }
    }
}
