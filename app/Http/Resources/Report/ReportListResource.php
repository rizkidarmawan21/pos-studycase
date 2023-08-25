<?php

namespace App\Http\Resources\Report;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ReportListResource extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => $this->transformCollection($this->collection),
            'meta' => [
                "success" => true,
                "message" => "Success get report lists",
                'pagination' => $this->metaData()
            ]
        ];
    }

    private function transformData($data)
    {
        return [
            'id' => $data->id,
            'cashier' => $data->cashier,
            'invoice_code' => $data->invoice_code,
            'cash' => $data->cash,
            'cash_formatted' => number_format($data->cash, 2, ',', '.'),
            'change' => $data->change,
            'change_formatted' => number_format($data->change, 2, ',', '.'),
            'grand_total' => $data->grand_total,
            'grand_total_formatted' => number_format($data->grand_total, 2,',', '.'),
            'transaction_details' => $data->transaction_details,
            'created_at' => Carbon::parse($data->created_at)->format('d F Y')
        ];
    }

    private function transformCollection($collection)
    {
        return $collection->transform(function ($data) {
            return $this->transformData($data);
        });
    }

    private function metaData()
    {
        return [
            "total" => $this->total(),
            "count" => $this->count(),
            "per_page" => (int)$this->perPage(),
            "current_page" => $this->currentPage(),
            "total_pages" => $this->lastPage(),
            "links" => [
                "next" => $this->nextPageUrl()
            ],
        ];
    }
}
