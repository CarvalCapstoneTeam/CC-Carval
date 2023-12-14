<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    public function updateProfile(Request $request)
    {
        try {
            $user = Auth::guard('api')->user();
            $request->validate([
                'name' => 'nullable',
                'email' => 'email|unique:users,email,' . $user->id,
            ]);

            User::where('id', $user->id)->update([
                'name' => $request->name,
                'email' => $request->email
            ]);

            return response()->json([
                'error' => false,
                'message' => 'Profile updated successfully'
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
}
