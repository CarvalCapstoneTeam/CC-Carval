<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ResetPasswordController extends Controller
{
    public function sendForgotPasswordEmail(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required'
            ]);

            $user = User::where('email', $request->email)->first();

            if (!$user) {
                return response()->json([
                    'error' => true,
                    'message' => 'User not found'
                ], 404);
            }

            $user->sendForgotPasswordnNotification();

            return response()->json([
                'error' => false,
                'message' => 'OTP code has been sent to email'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ], 422);
        }
    }

    public function verifyOtpResetPassword(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json([
                'error' => true,
                'message' => 'User not found'
            ], 404);
        }

        if ($user->verifyOtpResetPassword($request->otp)) {
            return response()->json([
                'error' => false,
                'message' => 'OTP verified successfully'
            ]);
        }

        return response()->json([
            'error' => true,
            'message' => 'Invalid or expired OTP'
        ], 422);
    }
}
