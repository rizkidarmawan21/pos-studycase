<?php

namespace App\Http\Controllers\Api\Settings;

use App\Http\Controllers\ApiBaseController;
use App\Http\Requests\Api\Settings\Role\CreateRoleRequest;
use App\Http\Requests\Api\Settings\Role\UpdateRoleRequest;
use App\Http\Resources\Api\Settings\Role\RoleManagementListResource;
use App\Http\Resources\Api\Settings\Role\SubmitRoleResource;
use App\Services\Api\Settings\Role\RoleService;
use Illuminate\Http\Request;

class RoleController extends ApiBaseController
{
    public function __construct(RoleService $roleService)
    {
        $this->roleService = $roleService;
    }

    public function getData(Request $request)
    {
        try {
            $data = $this->roleService->getData($request);
            $result = new RoleManagementListResource($data);
            return $this->respond($result);
        } catch (\Exception $e) {
            return $this->exceptionError($e->getMessage());
        }
    }

    public function createData(CreateRoleRequest $request)
    {
        try {
            $data = $this->roleService->createData($request);
            $result = new SubmitRoleResource($data, 'Success Create Role');
            return $this->respond($result);
        } catch (\Exception $e) {
            return $this->exceptionError($e->getMessage());
        }
    }

    public function updateData($id, UpdateRoleRequest $request)
    {
        try {
            $data = $this->roleService->updateData($id, $request);
            $result = new SubmitRoleResource($data, 'Success Update Role');
            return $this->respond($result);
        } catch (\Exception $e) {
            return $this->exceptionError($e->getMessage());
        }
    }

    public function deleteData($id)
    {
        try {
            $data = $this->roleService->deleteData($id);
            $result = new SubmitRoleResource($data, 'Success Delete Role');
            return $this->respond($result);
        } catch (\Exception $e) {
            return $this->exceptionError($e->getMessage());
        }
    }
}
