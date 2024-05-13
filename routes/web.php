<?php

use App\Http\Controllers\Aduan\AduanController;
use App\Http\Controllers\Aspirasi\AspirasiController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Chat\ChatController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Feed\FeedController;
use App\Models\Aduan;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


// Rute untuk admin
// Route::get('/login', function () {
//     return view('auth.login');
// })->name('auth.login');

Route::get('/admin/login', function () {
    return view('auth.login');
})->name('admin.login');


Route::middleware(['web', 'auth'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout.submit');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');



    Route::get('/aspirasi', [AspirasiController::class, 'index'])->name('aspirasi.index');
    Route::get('/feed', [FeedController::class, 'index'])->name('feed.index');
});
