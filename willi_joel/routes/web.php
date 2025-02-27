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
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

/*Route::get('/alta-empleado', function () {
    return "Página de alta de empleado"; // Temporal, hasta que crees el controlador real
})->name('altaEmpleado');

Route::get('/alta-masiva', function () {
    return "Página de alta masiva de empleados";
})->name('altaMasiva');

Route::get('/modificar-salario', function () {
    return "Página de modificación de salario";
})->name('modificarSalario');

Route::get('/vida-laboral', function () {
    return "Página de vida laboral";
})->name('vidaLaboral');

Route::get('/info-departamento', function () {
    return "Información del departamento";
})->name('infoDepartamento');

Route::get('/cambio-departamento', function () {
    return "Cambio de departamento";
})->name('cambioDepartamento');

Route::get('/cambio-jefe', function () {
    return "Cambio de jefe de departamento";
})->name('cambioJefe');

Route::get('/baja-empleado', function () {
    return "Baja de empleado";
})->name('bajaEmpleado');

Route::get('/nomina', function () {
    return "Página de nómina";
})->name('nomina');

Route::get('/historial-laboral', function () {
    return "Historial laboral";
})->name('historialLaboral');*/
