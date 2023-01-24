<?php

namespace App\Http\Resources\Transaction;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CartListResource extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        $data = $this->transformCollection($this->collection);

        return [
            'data' => $data,
            'grand_total' => collect($data)->sum('sub_total'),
            'meta' => [
                "success" => true,
                "message" => "Success get cart lists",
                "pagination" => (object)[],
            ]
        ];
    }

    private function transformData($data)
    {
        return [
            'id' => $data->id,
            'product' => [
                'id' => $data->product->id,
                'name' => $data->product->name,
                'description' => $data->product->description,
                'preview_image' => $data->product->image,
                'price' => (int)$data->product->price,
                'price_formatted' => number_format($data->product->price, 2, ',', '.'),
                'stock' => $data->product->stock,
                'category_id' => $data->product->category_id,
                'category_name' => $data->product->category->name
            ],
            'qty' => $data->qty,
            'sub_total' => $data->price,
            'sub_total_formatted' => number_format($data->price, 2, ',', '.'),
        ];
    }

    private function transformCollection($collection)
    {
        return $collection->transform(function ($data) {
            return $this->transformData($data);
        });
    }
}
