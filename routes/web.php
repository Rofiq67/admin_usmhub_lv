<?php

use App\Http\Controllers\Aduan\AduanController;
use App\Http\Controllers\Aspirasi\AspirasiController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Chat\ChatController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Feed\FeedController;
use App\Http\Controllers\Komentar\KomentarController;
use App\Http\Controllers\User\UserController;
use App\Models\Aduan;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


// Rute untuk admin
// Route::get('/login', function () {
//     return view('auth.login');
// })->name('auth.login');

Route::get('/login', function () {
    return view('auth.login');
})->name('auth.login');


Route::middleware(['web', 'auth'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout.submit');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    Route::get('/pengaduan', [AduanController::class, 'index'])->name('pengaduan.index');
    Route::get('/pengaduan/view/{id}', [AduanController::class, 'view'])->name('pengaduan.view');
    Route::put('/pengaduan/updateStatus/{id}/{status}', [AduanController::class, 'updateStatus'])->name('pengaduan.updateStatus');
    // 
    Route::post('/komentar/kirim', [KomentarController::class, 'kirimKomentar'])->name('kirim.komentar');
    Route::get('/komentar/{id}/edit', [KomentarController::class, 'edit'])->name('komentar.edit');
    Route::put('/komentar/{id}/update', [KomentarController::class, 'updateKomentar'])->name('komentar.update');
    Route::delete('/komentar/{id}', [KomentarController::class, 'destroy'])->name('komentar.destroy');

    //
    Route::get('/aspirasi', [AspirasiController::class, 'index'])->name('aspirasi.index');
    Route::get('/aspirasi/view/{id}', [AspirasiController::class, 'view'])->name('aspirasi.view');
    Route::put('/aspirasi/updateStatus/{id}/{status}', [AspirasiController::class, 'updateStatus'])->name('aspirasi.updateStatus');


    Route::get('/feed', [FeedController::class, 'index'])->name('feed.index');
    Route::get('/feed/create', [FeedController::class, 'create'])->name('feed.create');
    Route::get('/feed/view/{id}', [FeedController::class, 'view'])->name('feed.view');
    Route::post('/feed', [FeedController::class, 'store'])->name('feed.store');
    Route::get('/feed/{id}/edit', [FeedController::class, 'edit'])->name('feed.edit');
    Route::put('/feed/{id}', [FeedController::class, 'update'])->name('feed.update');
    // Route::post('/feed/upload-attachment', [FeedController::class, 'uploadAttachment'])->name('feed.upload_attachment');
    Route::delete('/feed/{id}', [FeedController::class, 'destroy'])->name('feed.destroy');
    Route::post('/feed/upload/{id}', [FeedController::class, 'upload'])->name('feed.upload');

    Route::get('/datamhs', [UserController::class, 'index'])->name('users.index');
    Route::get('/datamhs/view/{id}', [UserController::class, 'view'])->name('users.view');
});
