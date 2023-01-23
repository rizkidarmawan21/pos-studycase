<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Services\ProductService;
use App\Actions\Options\GetCategoryOptions;
use App\Http\Requests\Product\CreateProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Http\Resources\Product\ProductListResource;
use App\Http\Resources\Product\SubmitProductResource;

class ProductController extends Controller
{
    public function __construct(ProductService $productService, GetCategoryOptions $getCategoryOptions)
    {
        $this->productService = $productService;
        $this->getCategoryOptions = $getCategoryOptions;
    }

    public function index()
    {
        return Inertia::render('admin/product/index', [
            "title" => 'POS | Product',
            "additional" => [
                'category_list' => $this->getCategoryOptions->handle()
            ]
        ]);
    }

    public function getData(Request $request)
    {
        try {
            $data = $this->productService->getData($request);

            $result = new ProductListResource($data);
            return $this->respond($result);
        } catch (\Exception $e) {
            return $this->exceptionError($e->getMessage());
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
