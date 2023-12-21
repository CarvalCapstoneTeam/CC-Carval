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
    /**
     * Update User Profile
     * 
     * This endpoint is used to update user profiles such as name and email.
     * 
     * @bodyParam name string required
     * <ul>
     *      <li>Maximum of 255 characters.</li>
     * </ul>
     * Example: gojosatoru@gmail.com
     * 
     * @bodyParam email string required
     * <ul>
     *      <li>Must be a valid email address.</li>
     *      <li>Maximum of 100 characters.</li>
     *      <li>Must be unique (cannot be an email that has already been registered).</li>
     * </ul>
     * Example: gojosatoru@gmail.com
     */
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

    /**
     * Change Password
     * 
     * This endpoint is used to change the user's password.
     * 
     * @bodyParam current_password string required
     * Example: Yowaimo123
     * 
     * @bodyParam new_password string required
     * <ul>
     *      <li>Minimum of 8 characters.</li>
     *      <li>Must contain both uppercase and lowercase letters.</li>
     *      <li>Must contain at least one number.</li>
     *      <li>Must match the new_password_confirmation field.</li>
     * </ul>
     * Example: JujutsuKaisen23
     * 
     * @bodyParam new_password_confirmation string required
     * Example: JujutsuKaisen23
     */
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
