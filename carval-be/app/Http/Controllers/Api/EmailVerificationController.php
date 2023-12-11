<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EmailVerificationController extends Controller
{
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
