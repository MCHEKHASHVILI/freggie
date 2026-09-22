<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\UserRoleController;
use App\Http\Controllers\Api\UserStatusController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::apiResource('users', UserController::class);
    Route::put('/users/{user}/status', [UserStatusController::class, 'update'])->name('users.status.update');
    Route::put('/users/{user}/roles', [UserRoleController::class, 'update'])->name('users.roles.update');
});
