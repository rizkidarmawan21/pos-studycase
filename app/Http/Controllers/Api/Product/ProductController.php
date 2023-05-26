<?php

namespace App\Http\Controllers\Api\Product;

use App\Actions\Options\GetCategoryOptions;
use App\Http\Controllers\ApiBaseController;
use App\Http\Controllers\Controller;
use App\Http\Resources\Product\ProductListResource;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends ApiBaseController
{
    public function __construct(ProductService $productService, GetCategoryOptions $getCategoryOptions)
    {
        $this->productService = $productService;
        $this->getCategoryOptions = $getCategoryOptions;
    }

    public function getData(Request $request)
    {
        try {
            $data = $this->productService->getData($request);

            $result = new ProductListResource($data);
            return $this->respond($result);
        } catch (\Exception $e) {
            return $this->exceptionError($e->getMessage(), $e->getCode());
        }
    }
}
