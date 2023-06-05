<?php

namespace App\Http\Requests\Api\Product;

use App\Http\Requests\ApiBaseRequest;

class CreateProductRequest extends ApiBaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|string',
            'description' => 'required|string',
            'image' => 'required|file|max:3072|mimes:jpg,jpeg,png',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required',
            'stock' => 'required'
        ];
    }
}
