<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProducaoController;
use App\Http\Controllers\FuncionarioController;
use App\Http\Controllers\ContagemController;


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me',      [AuthController::class, 'me']);

    Route::apiResource('producoes', ProducaoController::class);
    Route::apiResource('funcionarios', FuncionarioController::class);

    Route::get('/contagem', [ContagemController::class, 'contagens']);
});
