<?php

use App\Http\Controllers\Api\AppSettingController;
use App\Http\Controllers\Api\AboutUsController;
use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\CandidateController;
use App\Http\Controllers\Api\ComplaintController;
use App\Http\Controllers\Api\EventController;
use App\Http\Controllers\Api\LocationController;
use App\Http\Controllers\Api\NewsController;
use App\Http\Controllers\Api\SliderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;




Route::group(['middleware' => ['guest']], function () {
    Route::get('/governorates', [LocationController::class, 'governorates'])->name('locations.governorates');
    Route::get('/districts', [LocationController::class, 'districts'])->name('locations.districts');
    Route::get('/local-units', [LocationController::class, 'localUnits'])->name('locations.local-units');
    Route::get('/party-units', [LocationController::class, 'partyUnits'])->name('locations.party-units');

    Route::post('register', [AuthController::class, 'register'])->name('auth.register');
    Route::post('verify-phone', [AuthController::class, 'verifyPhone'])->name('auth.verifyPhone');
    Route::post('login', [AuthController::class, 'login'])->name('auth.login');
    Route::post('login-otp', [AuthController::class, 'loginOTP'])->name('auth.loginOTP');
});

Route::post('complaints', [ComplaintController::class, 'store'])
    ->middleware('throttle:5,1')
    ->name('complaints.store');

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/user', [AuthController::class, 'profile'])->name('profile');
    Route::post('/update-profile', [AuthController::class, 'updateProfile'])->name('profile.update');
    Route::post('logout', [AuthController::class, 'logout'])->name('auth.logout');

    Route::get('events',[EventController::class,'index'])->name('events.index');
    Route::get('events/{id}',[EventController::class,'show'])->name('events.show');

    Route::get('news',[NewsController::class,'index'])->name('news.index');
    Route::get('news/{id}',[NewsController::class,'show'])->name('news.show');

    Route::get('candidates',[CandidateController::class,'index'])->name('candidates.index');
    Route::get('candidates/{id}',[CandidateController::class,'show'])->name('candidates.show');

    Route::get('sliders',[SliderController::class,'index'])->name('sliders.index');

    Route::get('app-settings',[AppSettingController::class,'index'])->name('app-settings.index');
    Route::get('about-us/vision',[AboutUsController::class,'vision'])->name('about-us.vision');
    Route::get('about-us/faqs',[AboutUsController::class,'faqs'])->name('about-us.faqs');
    Route::get('about-us/contact-mail',[AboutUsController::class,'contactMail'])->name('about-us.contact-mail');
    Route::get('about-us/membership-form-url',[AboutUsController::class,'membershipFormUrl'])->name('about-us.membership-form-url');
});
