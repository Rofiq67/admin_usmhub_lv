<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Upload\UploadFileController;
use Illuminate\Support\Facades\Route;


Route::get('/test', function () {
    return response([
        'message' => 'Api is working'
    ], 200);
});

Route::controller('/', 'TestController');

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

Route::post('/upload/komentar', [UploadFileController::class, 'uploadKomentar'])->name('uploadKomentar');
Route::post('/upload/aduan', [UploadFileController::class, 'uploadAduan'])->name('uploadAduan');
Route::post('/upload/user', [UploadFileController::class, 'uploadUser'])->name('uploadUser');



Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']); // Rute untuk proses logout user mobile
});
