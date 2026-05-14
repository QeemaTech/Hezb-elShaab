<?php

use App\Http\Controllers\Api\AppSettingController;
use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\CandidateController;
use App\Http\Controllers\Api\EventController;
use App\Http\Controllers\Api\NewsController;
use App\Http\Controllers\Api\SliderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;




Route::group(['middleware' => ['guest']], function () {
    Route::post('register', [AuthController::class, 'register'])->name('auth.register');
    Route::post('verify-phone', [AuthController::class, 'verifyPhone'])->name('auth.verifyPhone');
    Route::post('login', [AuthController::class, 'login'])->name('auth.login');
    Route::post('login-otp', [AuthController::class, 'loginOTP'])->name('auth.loginOTP');
});

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/user', [AuthController::class, 'profile'])->name('profile');
    Route::post('logout', [AuthController::class, 'logout'])->name('auth.logout');

    Route::get('events',[EventController::class,'index'])->name('events.index');
    Route::get('events/{id}',[EventController::class,'show'])->name('events.show');

    Route::get('news',[NewsController::class,'index'])->name('news.index');
    Route::get('news/{id}',[NewsController::class,'show'])->name('news.show');

    Route::get('candidates',[CandidateController::class,'index'])->name('candidates.index');
    Route::get('candidates/{id}',[CandidateController::class,'show'])->name('candidates.show');

    Route::get('sliders',[SliderController::class,'index'])->name('sliders.index');

    Route::get('app-settings',[AppSettingController::class,'index'])->name('app-settings.index');
});

