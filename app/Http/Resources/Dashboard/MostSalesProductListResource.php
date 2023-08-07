<?php

namespace App\Http\Resources\Dashboard;

use Illuminate\Http\Resources\Json\ResourceCollection;

class MostSalesProductListResource extends ResourceCollection
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
                "message" => "Success get most sales product lists",
            ]
        ];
    }

    private function transformData($data)
    {
        return [
            'id' => $data->id,
            'category_id' => $data->category_id,
            'name' => $data->name,
            'image' => $data->image,
            'price' => $data->price,
            'stock' => $data->stock,
            'description' => $data->description,
            'total' => $data->total,
            'earnings' => $data->total_price,
            'earnings_formatted' => number_format($data->total_price, 2, ',', '.'),
        ];
    }

    private function transformCollection($collection)
    {
        return $collection->transform(function ($data) {
            return $this->transformData($data);
        });
    }
}
