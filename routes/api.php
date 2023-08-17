<?php

use App\Http\Controllers\API\Auth\AuthController;
use App\Http\Controllers\API\PengaduanController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/dataonprocess', [PengaduanController::class, 'getDataOnProcess']);
    Route::get('/dataselesai', [PengaduanController::class, 'getDataSelesai']);
    Route::post('/laporan', [PengaduanController::class, 'store']);
    Route::get('/laporan/{id}', [PengaduanController::class, 'show']);
    Route::delete('/laporan/{id}', [PengaduanController::class, 'destroy']);
});

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
