<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LandingController;
use App\Http\Controllers\Frontend\BeritaController;
use App\Http\Controllers\Frontend\PengurusController;
use App\Http\Controllers\Frontend\DasarHukumController;
use App\Http\Controllers\Frontend\FilosofiLogoController;
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

Route::resource('/', LandingController::class)->only(['index']);
Route::resource('/berita', BeritaController::class)->only(['index', 'show']);


Route::resource('/filosofi-logo', FilosofiLogoController::class)->only('index');
Route::resource('/struktur-organisasi', PengurusController::class)->only('index');

Route::resource('/dasar-hukum', DasarHukumController::class)->only('index');
Route::resource('/kekerasan-seksual', KekerasanSeksualController::class)->only('index');


// Route::get('/', function () {
//     return view('welcome');
// });
