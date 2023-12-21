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
    /**
     * Send Email Forgot Password
     * 
     * This endpoint is used to send forgot password emails to users.
     * 
     * @bodyParam email string required
     * <ul>
     *      <li>Must be filled</li>
     *      <li>Must be a valid email address.</li>
     * </ul>
     * Example: gojosatoru@gmail.com
     */
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

    /**
     * Verify OTP Forgot Password
     * 
     * This endpoint is used to check the validity of the OTP code for reset password.
     * 
     * @bodyParam email string required
     * <ul>
     *      <li>Must be filled</li>
     *      <li>Must be a valid email address.</li>
     * </ul>
     * Example: gojosatoru@gmail.com
     * 
     * @bodyParam otp string required
     * <ul>
     *      <li>Must be filled</li>
     *      <li>Must match the otp sent to the email.</li>
     * </ul>
     * Example: 7859
     */
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

    /**
     * Reset Password
     * 
     * This endpoint is used to reset the password after the otp has been verified.
     * 
     * @bodyParam email string required
     * <ul>
     *      <li>Must be filled</li>
     *      <li>Must be a valid email address.</li>
     * </ul>
     * Example: gojosatoru@gmail.com
     * 
     * @bodyParam new_password string required
     * <ul>
     *      <li>Must be filled</li>
     *      <li>Minimum of 8 characters.</li>
     *      <li>Must contain both uppercase and lowercase letters.</li>
     *      <li>Must contain at least one number.</li>
     * </ul>
     * Example: JujutsuKaisen23
     * 
     * @bodyParam new_password_confirmation string required
     * <ul>
     *      <li>Must be filled</li>
     *      <li>Must match the new_password field.</li>
     * </ul>
     * Example: JujutsuKaisen23
     */
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
