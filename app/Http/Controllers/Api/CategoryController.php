<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiBaseController;
use App\Http\Requests\Api\Category\CreateCategoryRequest;
use App\Http\Requests\Api\Category\UpdateCategoryRequest;
use App\Http\Resources\Api\Category\CategoryListResource;
use App\Http\Resources\Api\Category\SubmitCategoryResource;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Services\Api\CategoryService;

class CategoryController extends ApiBaseController
{
    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function getData(Request $request)
    {
        try {
            $data = $this->categoryService->getData($request);

            $result = new CategoryListResource($data);
            return $this->respond($result);
        } catch (\Exception $e) {
            return $this->exceptionError($e->getMessage());
        }
    }

    public function createData(CreateCategoryRequest $request)
    {
        try {
            $data = $this->categoryService->createData($request);

            $result = new SubmitCategoryResource($data, 'Success Create Category');
            return $this->respond($result);
        } catch (\Exception $e) {
            return $this->exceptionError($e->getMessage());
        }
    }

    public function updateData($id, UpdateCategoryRequest $request)
    {
        try {
            $data = $this->categoryService->updateData($id, $request);

            $result = new SubmitCategoryResource($data, 'Success Update Category');
            return $this->respond($result);
        } catch (\Exception $e) {
            return $this->exceptionError($e->getMessage());
        }
    }

    public function deleteData($id)
    {
        try {
            $data = $this->categoryService->deleteData($id);

            $result = new SubmitCategoryResource($data, 'Success Delete Category');
            return $this->respond($result);
        } catch (\Exception $e) {
            return $this->exceptionError($e->getMessage());
        }
    }
}
