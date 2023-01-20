<?php

namespace App\Http\Controllers\Auth;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    protected function sendResetLinkResponse($response)
    {
        return response()->json([
            'message' => 'success'
        ]);
    }

    public function showLinkRequestForm()
    {
        return Inertia::render('admin/auth/reset-password', [
            "title" => 'Reset Password'
        ]);
    }

    protected function sendResetLinkFailedResponse(Request $request, $response)
    {
        return response()->json([
            'message' => 'Something wrong, please try again later'
        ], 422);
    }
}
