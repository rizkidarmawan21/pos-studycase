<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\CreateCustomerRequest;
use App\Http\Requests\Customer\UpdateCustomerRequest;
use App\Http\Resources\Customer\CustomerListResource;
use App\Http\Resources\Customer\SubmitCustomerResource;
use App\Services\CustomerService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CustomerController extends Controller
{
    public function __construct(CustomerService $customerService)
    {
        $this->customerService = $customerService;
    }

    public function index()
    {
        return Inertia::render('admin/customer/index', [
            "title" => 'POS | Category'
        ]);
    }

    public function getData(Request $request)
    {
        try {
            $data = $this->customerService->getData($request);

            $result = new CustomerListResource($data);
            return $this->respond($result);
        } catch (\Exception $e) {
            return $this->exceptionError($e->getMessage());
        }
    }

    public function createData(CreateCustomerRequest $request)
    {
        try {
            $data = $this->customerService->createData($request);

            $result = new SubmitCustomerResource($data, 'Success Create Customer');
            return $this->respond($result);
        } catch (\Exception $e) {
            return $this->exceptionError($e->getMessage());
        }
    }

    public function updateData($id, UpdateCustomerRequest $request)
    {
        try {
            $data = $this->customerService->updateData($id, $request);

            $result = new SubmitCustomerResource($data, 'Success Update Customer');
            return $this->respond($result);
        } catch (\Exception $e) {
            return $this->exceptionError($e->getMessage());
        }
    }

    public function deleteData($id)
    {
        try {
            $data = $this->customerService->deleteData($id);

            $result = new SubmitCustomerResource($data, 'Success Delete Customer');
            return $this->respond($result);
        } catch (\Exception $e) {
            return $this->exceptionError($e->getMessage());
        }
    }
}
