<?php

use Illuminate\Support\Facades\Route;


// Controladores
use App\Http\Controllers\Api\JwtAuthController;
use App\Http\Controllers\Api\UserApiController;
use App\Http\Controllers\Api\ActivityController;
use App\Http\Controllers\Api\ApiTransactionsController;
use App\Http\Controllers\Api\ApiCategoriesController;

// grupo de rutas API para la el registro y el login
Route::prefix('auth')->group(function () {
    Route::post('register', [JwtAuthController::class, 'register']);
    Route::post('login', [JwtAuthController::class, 'login']);
});



Route::get('activities', [ActivityController::class, 'index']);
Route::apiResource('transactions', ApiTransactionsController::class);
Route::apiResource('categories', ApiCategoriesController::class);


// TODO: Más adelante aplicar middleware cuando configuremos correctamente JWT o sesiones
Route::middleware(['jwt.verify', 'role:admin'])->group(function () {
    Route::get('users', [UserApiController::class, 'index']);
    Route::get('users/{id}', [UserApiController::class, 'show']);
    Route::put('users/{id}', [UserApiController::class, 'update']);
    Route::delete('users/{id}', [UserApiController::class, 'destroy']);
});