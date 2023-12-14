<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        try {
            $request->validated();

            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);

            return response()->json([
                'error' => false,
                'message' => 'User Created',
            ]);
        } catch (ValidationException $e) {
            $errors = $e->errors();
            $errorMessage = reset($errors)[0];

            return response()->json([
                'error' => true,
                'message' => $errorMessage,
            ], 422);
        }
    }

    public function login(LoginRequest $request)
    {
        try {
            $request->authenticate();
            $token = JWTAuth::fromUser(Auth::guard('api')->user());
            $loginResult = Auth::guard('api')->user();
            $loginResult['token'] = $token;

            return response()->json([
                'error' => false,
                'message' => 'success',
                'loginResult' => $loginResult
            ]);
        } catch (ValidationException $e) {
            $errors = $e->errors();
            $errorMessage = reset($errors)[0];

            return response()->json([
                'error' => true,
                'message' => $errorMessage,
            ], 401);
        }
    }

    public function logout()
    {
        Auth::guard('api')->logout();

        return response()->json([
            'error' => false,
            'message' => 'User Logged Out'
        ]);
    }

    public function me()
    {
        $user = Auth::guard('api')->user();

        return response()->json($user);
    }
}
