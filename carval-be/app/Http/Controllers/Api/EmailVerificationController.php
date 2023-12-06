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
        
        // return response()->json('tes');
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
            ]);
        }

        $user->sendEmailVerificationNotification();

        return response()->json([
            'error' => false,
            'message' => 'OTP code has been sent to email'
        ]);
    }
}
