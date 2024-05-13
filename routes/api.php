<?php

use App\Http\Controllers\Aduan\AduanController;
use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\Aspirasi\AspirasiController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Feed\FeedController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/test', function () {
    return response([
        'message' => 'Api is working'
    ], 200);
});

Route::controller('/', 'TestController');



Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');



Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']); // Rute untuk proses logout user mobile


});
