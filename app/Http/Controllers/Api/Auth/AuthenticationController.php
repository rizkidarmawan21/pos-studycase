<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\ApiBaseController;
use App\Http\Resources\Api\Auth\AuthenticationResource;
use App\Http\Resources\Api\Auth\RefreshTokenResource;
use App\Services\Api\AuthenticationService;
use Illuminate\Http\Request;
use stdClass;

class AuthenticationController extends ApiBaseController
{
    public function __construct(AuthenticationService $authenticationService)
    {
        $this->authenticationService = $authenticationService;
    }

    public function login(Request $request)
    {
        try {
            $data = $this->authenticationService->login($request);

            $result = new AuthenticationResource($data, 'Login success');

            return $this->respond($result);
        } catch (\Exception $e) {
            return $this->exceptionError($e->getMessage(), $e->getCode());
        }
    }

    public function logout()
    {
        try {
            auth('api')->logout();
            return $this->messageSuccess('Logout success', 200);
        } catch (\Exception $e) {
            return $this->exceptionError($e->getMessage(), $e->getCode());
        }
    }

    public function refresh()
    {
        try {
            $data = new stdClass();
            $data->token = auth('api')->refresh();

            $final = new RefreshTokenResource($data, 'Success Refresh Token');
            return $this->respond($final);
        } catch (\Exception $e) {
            return $this->exceptionError($e->getMessage(), $e->getCode());
        }
    }
}
