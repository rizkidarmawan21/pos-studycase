<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Services\CategoryService;
use App\Http\Requests\Category\CreateCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Http\Resources\Category\CategoryListResource;
use App\Http\Resources\Category\SubmitCategoryResource;

class CategoryController extends Controller
{
    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index()
    {
        return Inertia::render('admin/category/index', [
            "title" => 'POS | Category'
        ]);
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
