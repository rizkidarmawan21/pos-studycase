<?php

namespace App\Http\Controllers\Auth;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    protected function sendResetLinkResponse($response)
    {
        return response()->json([
            'message' => 'success'
        ]);
    }

    public function showResetForm(Request $request, $token = null)
    {
        return Inertia::render('admin/auth/change-password', [
            'token' => $token,
            'email' => $request->email,
            "title" => 'BattleHr | Change Password'
        ]);
    }

    protected function sendResetLinkFailedResponse(Request $request, $response)
    {
        return response()->json([
            'message' => 'Something wrong, please try again later'
        ], 422);
    }
}
