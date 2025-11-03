<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HabitController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('login', [AuthController::class, 'login']);

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::controller(HabitController::class)->group(function () {
        Route::get('habits', [HabitController::class, 'index']);
        Route::post('habits', [HabitController::class, 'store']);
        Route::get('habits/{habit}', [HabitController::class, 'show']);
        Route::put('habits/{habit}', [HabitController::class, 'update']);
        Route::delete('habits/{habit}', [HabitController::class, 'destroy']);
    });

});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
