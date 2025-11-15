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
use App\Http\Controllers\DetalleAsistenciaController;
use App\Http\Controllers\ReporteController; 
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
Route::resource('cursos', CursoController::class);
Route::resource('docentes', DocenteController::class);
Route::resource('infantes-tutores', InfantesTutoreController::class);
Route::resource('inscripciones', InscripcioneController::class);
Route::resource('detalle-asistencias', DetalleAsistenciaController::class);

// Rutas de Asistencias
Route::get('asistencias/generar', [AsistenciaController::class, 'generarAsistencia'])
    ->name('asistencias.generarAsistencia');

Route::resource('asistencias', AsistenciaController::class);

// ============================================
// NUEVA RUTA PARA LISTA GENERAL DE INSCRITOS
// ============================================

      // Vista HTML de la lista general
Route::get('reportes/inscritos', [ReporteController::class, 'vistaListaGeneral'])
    ->name('reportes.lista_general');
    // PDF de la lista general
Route::get('reportes/inscritos/pdf', [ReporteController::class, 'listaGeneralPDF'])
    ->name('reportes.lista_general_pdf');


    // Formulario de filtrado
Route::get('reportes/inscritos/filtrar', [ReporteController::class, 'formFiltrar'])
    ->name('reportes.form_filtrar');
    // PDF filtrado
Route::get('reportes/inscritos/por-curso', [ReporteController::class, 'listaFiltradaPDF'])
    ->name('reportes.lista_filtrada_pdf');

    Route::get('reportes/asistencia/{asistencia}', [ReporteController::class, 'listaAsistenciaPDF'])
    ->name('reportes.asistencia_pdf');
// ============================================
Route::get('reportes/asistencias', [ReporteController::class, 'vistaAsistencias'])
    ->name('reportes.asistencias');

