<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HabitController;
use App\Http\Controllers\HabitLogController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('login', [AuthController::class, 'login']);

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::controller(HabitController::class)->group(function () {
        Route::get('habits', [HabitController::class, 'index']);
        Route::post('habits', [HabitController::class, 'store']);
        Route::get('habits/{id}', [HabitController::class, 'show']);
        Route::put('habits/{id}', [HabitController::class, 'update']);
        Route::delete('habits/{id}', [HabitController::class, 'destroy']);
    });

    Route::controller(HabitLogController::class)->group(function () {
        Route::get('habits/{id}/logs', 'index');
        Route::post('habits/{id}/logs', 'store');
    });

});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
