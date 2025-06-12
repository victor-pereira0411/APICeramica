<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProducaoController;
use App\Http\Controllers\FuncionarioController;


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/me', function () {
        return response()->json(auth()->user());
    });

    Route::apiResource('producoes', ProducaoController::class);
    Route::apiResource('funcionarios', FuncionarioController::class);
});
