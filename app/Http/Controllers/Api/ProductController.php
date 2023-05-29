<?php

namespace App\Http\Controllers\Api;

use App\Actions\Options\GetCategoryOptions;
use App\Http\Controllers\ApiBaseController;
use App\Http\Requests\Api\Product\CreateProductRequest;
use App\Http\Requests\Api\Product\UpdateProductRequest;
use App\Http\Resources\Api\Product\ProductListResource;
use App\Http\Resources\Api\Product\SubmitProductResource;
use App\Services\Api\ProductService;
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

    public function createData(CreateProductRequest $request)
    {
        try {
            $data = $this->productService->createData($request);

            $result = new SubmitProductResource($data, 'Success Create Product');
            return $this->respond($result);
        } catch (\Exception $e) {
            return $this->exceptionError($e->getMessage());
        }
    }

    public function updateData($id, UpdateProductRequest $request)
    {
        try {
            $data = $this->productService->updateData($id, $request);

            $result = new SubmitProductResource($data, 'Success Update Product');
            return $this->respond($result);
        } catch (\Exception $e) {
            return $this->exceptionError($e->getMessage());
        }
    }

    public function deleteData($id)
    {
        try {
            $data = $this->productService->deleteData($id);

            $result = new SubmitProductResource($data, 'Success Delete Product');
            return $this->respond($result);
        } catch (\Exception $e) {
            return $this->exceptionError($e->getMessage());
        }
    }
}
