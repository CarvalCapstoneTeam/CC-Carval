<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ArticleController;
use App\Http\Controllers\Api\EmailVerificationController;
use App\Http\Controllers\Api\NewsletterController;
use App\Http\Controllers\Api\PredictionController;
use App\Http\Controllers\Api\ResetPasswordController;
use App\Http\Controllers\Api\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Register
Route::post('register', [AuthController::class, 'register']);
// Login
Route::post('login', [AuthController::class, 'login']);
// Get All Articles
Route::get('articles', [ArticleController::class, 'getAllArticles']);
// Get Detail Article
Route::get('articles/{slug}/show', [ArticleController::class, 'showArticle']);
// Send Email Verification
Route::post('email-verification', [EmailVerificationController::class, 'sendVerificationEmail']);
// Verify Email
Route::post('verify-email', [EmailVerificationController::class, 'verifyEmail']);
// Send Email Forgot Password
Route::post('forgot-password', [ResetPasswordController::class, 'sendForgotPasswordEmail']);
// Verify OTP Reset Password
Route::post('verify-otp', [ResetPasswordController::class, 'verifyOtpResetPassword']);
// Reset Password
Route::post('reset-password', [ResetPasswordController::class, 'resetPassword']);
// Send Newsletter
Route::post('newsletter', [NewsletterController::class, 'sendNewsletter']);

Route::middleware('auth:api')->group(function () {
    // Logout
    Route::post('logout', [AuthController::class, 'logout']);
    // Get User Data
    Route::get('me', [AuthController::class, 'me']);
    // Check Token Validity
    Route::post('check-token', [AuthController::class, 'checkToken']);
    // Update User Profile
    Route::put('update-profile', [UserController::class, 'updateProfile']);
    // Change User Password
    Route::put('change-password', [UserController::class, 'changePassword']);

    Route::middleware('verified')->group(function () {
        // Predict Job Vacancy
        Route::post('predict', [PredictionController::class, 'predict']);
    });
});
