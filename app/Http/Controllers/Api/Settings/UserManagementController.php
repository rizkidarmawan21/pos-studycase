<?php

namespace App\Http\Controllers\Api\Settings;

use App\Http\Controllers\ApiBaseController;
use Illuminate\Http\Request;
use App\Services\Api\Settings\User\UserManagementService;
use App\Http\Requests\Api\Settings\User\CreateUserRequest;
use App\Http\Requests\Api\Settings\User\UpdateUserRequest;
use App\Http\Resources\Api\Settings\User\UserListResource;
use App\Http\Resources\Api\Settings\User\SubmitUserResource;

class UserManagementController extends ApiBaseController
{
    public function __construct(UserManagementService $userManagementService)
    {
        $this->userManagementService = $userManagementService;
    }

    public function getData(Request $request)
    {
        try {
            $data = $this->userManagementService->getData($request);

            $result = new UserListResource($data);
            return $this->respond($result);
        } catch (\Exception $e) {
            return $this->exceptionError($e->getMessage());
        }
    }

    public function createData(CreateUserRequest $request)
    {
        try {
            $data = $this->userManagementService->createData($request);

            $result = new SubmitUserResource($data, 'Success Create User');
            return $this->respond($result);
        } catch (\Exception $e) {
            return $this->exceptionError($e->getMessage());
        }
    }

    public function updateData($id, UpdateUserRequest $request)
    {
        try {
            $data = $this->userManagementService->updateData($id, $request);

            $result = new SubmitUserResource($data, 'Success Update User');
            return $this->respond($result);
        } catch (\Exception $e) {
            return $this->exceptionError($e->getMessage());
        }
    }

    public function deleteData($id)
    {
        try {
            $data = $this->userManagementService->deleteData($id);

            $result = new SubmitUserResource($data, 'Success Delete User');
            return $this->respond($result);
        } catch (\Exception $e) {
            return $this->exceptionError($e->getMessage());
        }
    }
}
