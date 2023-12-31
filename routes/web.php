<?php

use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\NewsletterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\DownloadController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', function () {
    return view('front.index');
})->name('home');

Route::get('/download', [DownloadController::class, 'download'])->name('download');

Route::middleware('auth:admin')->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('/article', [ArticleController::class, 'index'])->name('article.index');
    Route::get('/article/create', [ArticleController::class, 'create'])->name('article.create');
    Route::post('/article/store', [ArticleController::class, 'store'])->name('article.store');
    Route::get('/article/{slug}/show', [ArticleController::class, 'show'])->name('article.show');
    Route::get('/article/{slug}/edit', [ArticleController::class, 'edit'])->name('article.edit');
    Route::put('/article/{slug}/update', [ArticleController::class, 'update'])->name('article.update');
    Route::delete('/article/{slug}', [ArticleController::class, 'delete'])->name('article.delete');
    Route::get('/newsletter', [NewsletterController::class, 'index'])->name('newsletter.index');
    Route::delete('/newsletter/{id}', [NewsletterController::class, 'delete'])->name('newsletter.delete');

});

Route::middleware('guest:admin')->group(function () {
    Route::get('/login', [AuthController::class, 'index'])->name('login.index');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
});



