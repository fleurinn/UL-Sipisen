<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IzinController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [HomeController::class, 'index'])->name('home');

// Rute untuk menerima permintaan accept izin dari React JS
Route::patch('/accept_izin/{id}', [IzinController::class, 'accept_izin']);

// Rute untuk menerima permintaan reject izin dari React JS
Route::patch('/rejected_izin/{id}', [IzinController::class, 'rejected_izin']);
