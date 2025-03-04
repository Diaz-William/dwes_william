<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\WelcomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/employees', [LoginController::class, 'showLoginForm'])->name('login.form');
Route::post('/employees', [LoginController::class, 'login'])->name('login.process');

Route::get('/welcome_rrhh', [WelcomeController::class, 'showWelcomeRRHH'])->name('welcome_rrhh');
Route::get('/welcome_employees', [WelcomeController::class, 'showWelcomeEMP'])->name('welcome_employees');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
