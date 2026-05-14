<?php

use App\Http\Controllers\Web\CandidateController;
use App\Http\Controllers\Web\EventController;
use App\Http\Controllers\Web\NewsController;
use App\Http\Controllers\Web\PermissionController;
use App\Http\Controllers\Web\RoleController;
use App\Http\Controllers\Web\SliderController;
use App\Http\Controllers\Web\UserController;
use App\Http\Controllers\Web\HomeController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'auth'], function () {
    require __DIR__ . '/auth.php';
});


Route::get('/', function () {
    return redirect()->route('admin.dashboard');
});



Route::group(['middleware' => ['auth'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/dashboard', [HomeController::class,'index'])->name('dashboard');

    Route::middleware('role:super admin')->group(function () {
        Route::resource('roles',RoleController::class);
        Route::resource('permissions',PermissionController::class)->only('index');

        Route::get('/app-settings', [HomeController::class,'appSettings'])->name('appSettings.index');
        Route::post('/app-settings', [HomeController::class,'updateAppSettings'])->name('appSettings.update');
    });

    Route::middleware('permission:Users|Users List')->group(function () {
        Route::resource('users',UserController::class);
    });

    Route::middleware('permission:Users Member Action')->group(function () {
        Route::post('/users/{user}/accept', [UserController::class, 'accept']);
        Route::post('/users/{user}/reject', [UserController::class, 'reject']);
    });

    Route::middleware('permission:Candidates')->group(function () {
        Route::resource('candidates', CandidateController::class);
    });

    Route::middleware('permission:News')->group(function () {
        Route::resource('news', NewsController::class);
    });
    Route::resource('sliders', SliderController::class)->except(['show','edit','update']);

    // Route::middleware('role:super admin|permission:Events')->group(function () {
    // Route::middleware(['role_or_permission:super admin|Events'])->group(function () {
    // Route::group(function () {
        Route::resource('events', EventController::class);
        Route::delete('events/{event}/users/{user}', [EventController::class, 'removeUser'])->name('events.remove-user');
        Route::post('events/{event}/users', [EventController::class, 'addUser'])->name('events.add-users');
    // });
});
Route::get('/ajax-list', [HomeController::class, 'getAjaxList'])->name('ajax-list');

