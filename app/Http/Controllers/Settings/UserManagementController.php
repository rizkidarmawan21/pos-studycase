<?php

namespace App\Http\Controllers\Settings;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Actions\Options\GetRoleOptions;
use App\Services\Settings\User\UserManagementService;
use App\Http\Requests\Settings\User\CreateUserRequest;
use App\Http\Requests\Settings\User\UpdateUserRequest;
use App\Http\Resources\Settings\User\UserListResource;
use App\Http\Resources\Settings\User\SubmitUserResource;

class UserManagementController extends Controller
{
    public function __construct(UserManagementService $userManagementService, GetRoleOptions $getRoleOptions)
    {
        $this->userManagementService = $userManagementService;
        $this->getRoleOptions = $getRoleOptions;
    }

    public function index()
    {
        return Inertia::render('admin/settings/user/index', [
            "title" => 'POS | User managements',
            "additional" => [
                'role_list' => $this->getRoleOptions->handle(),
            ]
        ]);
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
