<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    public function updateProfile(Request $request)
    {
        try {
            $user = Auth::guard('api')->user();
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:100|unique:users,email,' . $user->id,
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

    public function changePassword(Request $request)
    {
        try {
            $user = Auth::guard('api')->user();

            if (!Hash::check($request->current_password, $user->password)) {
                throw new \Exception('The current password is wrong');
            }

            $request->validate([
                'current_password' => 'required',
                'new_password' => [
                    'required',
                    'confirmed:new_password_confirmation',
                    Password::min(8)->mixedCase()->numbers()
                ],
                'new_password_confirmation' => 'required'
            ]);

            if (Hash::check($request->new_password, $user->password)) {
                throw new \Exception('The new password must be different from the current password');
            }

            User::where('id', $user->id)->update([
                'password' => Hash::make($request->new_password)
            ]);

            return response()->json([
                'error' => false,
                'message' => 'Password changed successfully'
            ]);
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
