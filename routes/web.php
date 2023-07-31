<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LandingController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Frontend\BeritaController;
use App\Http\Controllers\Auth\RegistrationController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Frontend\PengurusController;
use App\Http\Controllers\Frontend\DasarHukumController;
use App\Http\Controllers\Frontend\FilosofiLogoController;
use App\Http\Controllers\Backend\DashboardAuthorController;
use App\Http\Controllers\Backend\DashboardBeritaController;
use App\Http\Controllers\Backend\DashboardJabatanController;
use App\Http\Controllers\Backend\DashboardPeriodeController;
use App\Http\Controllers\Backend\DashboardPetugasController;
use App\Http\Controllers\Backend\DashboardPenggunaController;
use App\Http\Controllers\Backend\DashboardPengurusController;
use App\Http\Controllers\Frontend\KekerasanSeksualController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


// Route All Have Access
Route::resource('/', LandingController::class)->only(['index']);
Route::resource('/berita', BeritaController::class)->only(['index', 'show']);
Route::resource('/filosofi-logo', FilosofiLogoController::class)->only('index');
Route::resource('/struktur-organisasi', PengurusController::class)->only('index');
Route::resource('/dasar-hukum', DasarHukumController::class)->only('index');
Route::resource('/kekerasan-seksual', KekerasanSeksualController::class)->only('index');


// Route Guest
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'authenticate'])->name('authenticate');
    Route::get('/registration', [RegistrationController::class, 'index'])->name('registrasi.index');
    Route::post('/registration', [RegistrationController::class, 'store'])->name('registrasi.store');
});


// Route All Role
Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::put('/registration/{id}', [RegistrationController::class, 'update'])->name('registrasi.update');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::resource('/profile', ProfileController::class);
    Route::resource('/dashboard/news', DashboardBeritaController::class);
    Route::resource('/dashboard/pengguna', DashboardPenggunaController::class)->only([
        'index',
        'destroy'
    ]);
    Route::resource('/dashboard/petugas', DashboardPetugasController::class)->only([
        'index',
        'destroy'
    ]);
    Route::resource('/dashboard/author', DashboardAuthorController::class)->only([
        'index',
        'destroy'
    ]);
    Route::resource('/dashboard/periode', DashboardPeriodeController::class)->except([
        'edit', 'create', 'show'
    ]);
    Route::resource('/dashboard/jabatan', DashboardJabatanController::class)->except([
        'edit', 'create', 'show'
    ]);
    Route::resource('/dashboard/pengurus', DashboardPengurusController::class);
});


// Route::get('/', function () {
//     return view('welcome');
// });
