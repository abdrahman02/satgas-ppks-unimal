<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\BeritaController;
use App\Http\Controllers\API\ProfilController;
use App\Http\Controllers\API\Auth\AuthController;
use App\Http\Controllers\API\PengaduanController;
use App\Http\Controllers\API\Auth\VerificationController;

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
    Route::put('/laporan/edit/{id}', [PengaduanController::class, 'update']);
    Route::get('/laporan/{id}', [PengaduanController::class, 'show']);
    Route::delete('/laporan/{id}', [PengaduanController::class, 'destroy']);
    Route::get('/user', [ProfilController::class, 'getUser']);
    Route::put('/user/edit', [ProfilController::class, 'editUser']);
    Route::get('/bio', [ProfilController::class, 'getBio']);
    Route::get('/check-bio', [ProfilController::class, 'checkBiodata']);
    Route::put('/bio/edit', [ProfilController::class, 'editBio']);
    Route::put('/password/edit', [ProfilController::class, 'ubahPassword']);
});

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/verify-email', [AuthController::class, 'googleSignInCheckEmail']);
Route::post('/register-email-google', [AuthController::class, 'registerGoogleSignIn']);
Route::get('/verify-email/{code}', [VerificationController::class, 'verify'])->name('api-verification.verify');
Route::post('/resend-verification-email', [VerificationController::class, 'resend'])->name('api-verification.resend');
