<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\CalculoController; // <-- Asegúrate de importar el controlador de la calculadora
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DesbasteController;
use App\Http\Controllers\AcabadoController;
use App\Http\Controllers\AlumnoController;
use App\Http\Controllers\LoginaController;
use App\Http\Controllers\DesbastelController;
use App\Http\Controllers\AcabadolController;
use App\Http\Controllers\SobreController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('posts', PostController::class);

// Ruta para el cálculo de RPM y avance de corte
Route::post('/calcular', [CalculoController::class, 'calcular'])->name('calcular');

//ruta de desbaste 
Route::resource('desbastes', DesbasteController::class);
Route::resource('acabados', AcabadoController::class);

//rutas para operaciones A
Route::resource('desbastels', DesbastelController::class);
Route::resource('acabadols', AcabadolController::class);

//alumnos
Route::resource('alumnos', AlumnoController::class);

//login
Route::resource('loginas', LoginaController::class);

// Rutas para verificar, para ruta de logina, para logout
Route::post('/verificar-alumno', [AlumnoController::class, 'verificar'])->name('alumnos.verificar');
Route::get('/logina/form', [LoginaController::class, 'form'])->name('logina.form');
Route::post('/logina/logout', [LoginaController::class, 'logout'])->name('logout');
Route::get('/welcome', function () {return view('welcome'); })->name('welcome');


// routes/web.php
Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');

//ver
Route::get('/desbastes/{id}', [DesbasteController::class, 'show'])->name('desbastes.show');
Route::get('/acabados/{id}', [AcabadoController::class, 'show'])->name('acabados.show');



//sobre nosotros
Route::resource('sobres', SobreController::class);
});

//PWA
Route::get('/offline', function () {
    return view('vendor.laravelpwa.offline');
});


