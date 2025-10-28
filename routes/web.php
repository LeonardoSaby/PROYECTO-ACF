<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\InfanteController;
use App\Http\Controllers\TutoreController;
use App\Http\Controllers\TurnoController;
use App\Http\Controllers\NiveleController;
use App\Http\Controllers\SalaController;
use App\Http\Controllers\DocenteController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\InfantesTutoreController;
use App\Http\Controllers\InscripcioneController;
use App\Http\Controllers\AsistenciaController;

use Livewire\Volt\Volt;

Route::get('/', function () {
    return view('welcome');
})->name('');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__.'/auth.php';

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Rutas de Administración y Catálogos
Route::resource('users', UserController::class);
Route::resource('roles', RoleController::class);
Route::resource('infantes', InfanteController::class);
Route::resource('tutores', TutoreController::class);
Route::resource('turnos', TurnoController::class);
Route::resource('niveles', NiveleController::class);
Route::resource('salas', SalaController::class);
Route::resource('docentes', DocenteController::class);
Route::resource('cursos', CursoController::class);
Route::resource('infantes-tutores', InfantesTutoreController::class);
Route::resource('inscripciones', InscripcioneController::class);

// *******************************************************************
// RUTAS DEL MÓDULO DE ASISTENCIA
// *******************************************************************

// 1. Ruta principal para el CRUD (index, create, store, show, edit, update, destroy)
Route::resource('asistencias', AsistenciaController::class);

// 2. RUTA ESPECÍFICA DE AJAX: Generar lista de infantes
// Nombre: asistencias.partes
Route::post('asistencias/partes', [AsistenciaController::class, 'generarLista'])
    ->name('asistencias.lista');
