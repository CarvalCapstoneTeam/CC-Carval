<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmailVerificationController extends Controller
{
    public function sendVerificationEmail(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return [
                'message' => 'Email has been verified'
            ];
        }

        $request->user()->sendEmailVerificationNotification();

        return response()->json([
            'error' => false,
            'message' => 'OTP code has been sent to email'
        ]);
    }
}
