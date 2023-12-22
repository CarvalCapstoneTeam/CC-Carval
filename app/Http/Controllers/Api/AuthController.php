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
    /**
     * Regsiter
     * 
     * This endpoint is used to register new users into the system.
     * 
     * @bodyParam name string required
     * <ul>
     *      <li>Maximum of 255 characters.</li>
     * </ul>
     * Example: Gojo Satoru
     * 
     * @bodyParam email string required
     * <ul>
     *      <li>Must be filled</li>
     *      <li>Must be a valid email address.</li>
     *      <li>Maximum of 100 characters.</li>
     *      <li>Must be unique (cannot be an email that has already been registered).</li>
     * </ul>
     * Example: gojosatoru@gmail.com
     * 
     * @bodyParam password string required
     * <ul>
     *      <li>Must be filled</li>
     *      <li>Minimum of 8 characters.</li>
     *      <li>Must contain both uppercase and lowercase letters.</li>
     *      <li>Must contain at least one number.</li>
     *      <li>Must match the password_confirmation field.</li>
     * </ul>
     * Example: Yowaimo123
     * 
     * @bodyParam password_confirmation string required
     * <ul>
     *      <li>Must be filled</li>
     *      <li>Must match the password field.</li>
     * </ul>
     * Example: Yowaimo123
     */
    public function register(RegisterRequest $request)
    {
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
    }

    /**
     * Login
     * 
     * This endpoint is used to perform the user login process into the system.
     * 
     * @bodyParam email string required
     * <ul>
     *      <li>Must be filled</li>
     *      <li>Must be a valid email address.</li>
     * </ul>
     * Example: gojosatoru@gmail.com
     * 
     * @bodyParam password string required
     * <ul>
     *      <li>Must be filled</li>
     * </ul>
     * Example: Yowaimo123
     */
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

    /**
     * Logout
     * 
     * This endpoint is used to log out users from the system.
     * 
     * @authenticated
     */
    public function logout()
    {
        Auth::guard('api')->logout();

        return response()->json([
            'error' => false,
            'message' => 'User Logged Out'
        ]);
    }

    /**
     * Get User Data
     * 
     * This endpoint is used to get user data such as name and email.
     * 
     * @authenticated
     */
    public function me()
    {
        $user = Auth::guard('api')->user();

        return response()->json([
            "error" => false,
            "message"=> "success",
            "id" => $user->id,
            "name" => $user->name,
            "email" => $user->email,
            "email_verified_at" => $user->email_verified_at
        ]);
    }

    /**
     * Check Token
     * 
     * This endpoint is used to check the validity of the token.
     * 
     * @authenticated
     */
    public function checkToken()
    {
        $token = JWTAuth::getToken();

        if (!$token) {
            return response()->json([
                'error' => true,
                'message' => 'Token is invalid'
            ], 401);
        }

        return response()->json([
            'error' => false,
            'message' => 'Token is valid',
        ]);
    }
}
