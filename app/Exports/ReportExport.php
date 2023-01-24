<?php

namespace App\Exports;

use App\Models\Transaction;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ReportExport implements FromView
{
    /**
     * __construct
     *
     * @param  mixed $start_date
     * @param  mixed $end_date
     * @return void
     */
    public function __construct($start_date, $end_date)
    {
        $this->start_date = $start_date;
        $this->end_date   = $end_date;
    }

    /**
     * view
     *
     * @return View
     */
    public function view(): View
    {
        $transactions = Transaction::with('cashier')->whereBetween('created_at', [$this->start_date, $this->end_date])->get();

        return view('export.transaction', [
            'transactions' => $transactions,
            'total' => collect($transactions)->sum('grand_total')
        ]);
    }
}
