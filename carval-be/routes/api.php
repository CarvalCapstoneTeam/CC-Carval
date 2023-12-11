<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ArticleController;
use App\Http\Controllers\Api\EmailVerificationController;

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
// Logout
Route::post('logout', [AuthController::class, 'logout']);
// Get User Data
Route::get('me', [AuthController::class, 'me']);
// Get All Articles
Route::get('articles', [ArticleController::class, 'getAllArticles']);
// Get Detail Article
Route::get('articles/{slug}/show', [ArticleController::class, 'showArticle']);

Route::post('email-verification', [EmailVerificationController::class, 'sendVerificationEmail']);
Route::post('verify-email', [EmailVerificationController::class, 'verifyEmail']);
