<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;

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

    public function resetPassword(Request $request)
    {
        try {
            $user = User::where('email', $request->email)->first();

            $request->validate([
                'email' => 'required',
                'new_password' => [
                    'required',
                    'confirmed:new_password_confirmation',
                    Password::min(8)->mixedCase()->numbers()
                ],
                'new_password_confirmation' => 'required',
            ]);

            if (!$user) {
                return response()->json([
                    'error' => true,
                    'message' => 'User not found'
                ], 404);
            }

            if ($user->otp_verified_at) {
                User::where('email', $request->email)->update([
                    'password' => Hash::make($request->new_password),
                    'otp_verified_at' => null
                ]);

                return response()->json([
                    'error' => false,
                    'message' => 'Password reset successfully'
                ]);
            }

            return response()->json([
                'error' => true,
                'message' => 'Invalid or expired OTP'
            ], 422);
        } catch (ValidationException $e) {
            $errors = $e->errors();
            $errorMessage = reset($errors)[0];

            return response()->json([
                'error' => true,
                'message' => $errorMessage,
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ], 422);
        }
    }
}
