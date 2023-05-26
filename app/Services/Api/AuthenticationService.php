<?php

namespace App\Services\Api;

class AuthenticationService
{

    public function login($request)
    {
        if ($token = auth('api')->attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = auth('api')->user();

            $data = $user;
            $data['token'] = $token;

            return $data;
        } else {
            throw new \Exception('Email atau password salah, silahkan hubungi admin untuk info lebih lanjut', 403);
        }
    }

    public function logout()
    {
    }

    public function refresh()
    {
    }
}
