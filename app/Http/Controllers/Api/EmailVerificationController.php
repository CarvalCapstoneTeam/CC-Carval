<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EmailVerificationController extends Controller
{
    /**
     * Send Email Verification
     * 
     * This endpoint is used to send verification email to users.
     * 
     * @bodyParam email string required
     * <ul>
     *      <li>Must be a valid email address.</li>
     * </ul>
     * Example: gojosatoru@gmail.com
     */
    public function sendVerificationEmail(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        
        if(!$user) {
            return response()->json([
                'error' => true,
                'message'=> 'User not found'
            ], 404);
        }

        if($user->hasVerifiedEmail()) {
            return response()->json([
                'error' => true,
                'message' => 'Email has been verified'
            ], 422);
        }

        $user->sendEmailVerificationNotification();

        return response()->json([
            'error' => false,
            'message' => 'OTP code has been sent to email'
        ]);
    }

    /**
     * Verify Email
     * 
     * This endpoint is used to send email verification to users.
     * 
     * @bodyParam email string required
     * <ul>
     *      <li>Must be a valid email address.</li>
     * </ul>
     * Example: gojosatoru@gmail.com
     * 
     * @bodyParam otp string required
     * <ul>
     *      <li>Must match the otp sent to the email.</li>
     * </ul>
     * Example: 3418
     */
    public function verifyEmail(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json([
                'error' => true,
                'message' => 'User not found'
            ], 404);
        }

        if($user->email_verified_at) {
            return response()->json([
                'error' => true,
                'message' => 'Email has been verified'
            ], 422); 
        }

        if ($user && $user->verifyOtp($request->otp)) {
            return response()->json([
                'error' => false,
                'message' => 'Email verified successfully'
            ]);
        }

        return response()->json([
            'error' => true,
            'message' => 'Invalid or expired OTP'
        ], 422);
    }
}
