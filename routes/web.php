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
use App\Http\Controllers\VistaTutorController;
use App\Http\Controllers\ModelHasRoleController;
use Livewire\Volt\Volt;

Route::get('/', fn() => view('welcome'))->name('');

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

// ==========================
// ADMINISTRACIÓN (solo Admin)
// ==========================

Route::group(['middleware' => ['auth', 'permission:access.users']], function() {
    Route::resource('users', UserController::class);
});
Route::group(['middleware' => ['auth', 'permission:access.roles']], function() {
    Route::resource('roles', RoleController::class);
});

// Parametrización completa (solo Admin)
Route::group(['middleware' => ['auth', 'permission:access.infantes']], function() {
    Route::resource('infantes', InfanteController::class);
});
Route::group(['middleware' => ['auth', 'permission:access.tutores']], function() {
    Route::resource('tutores', TutoreController::class);
});
Route::group(['middleware' => ['auth', 'permission:access.turnos']], function() {
    Route::resource('turnos', TurnoController::class);
});
Route::group(['middleware' => ['auth', 'permission:access.niveles']], function() {
    Route::resource('niveles', NiveleController::class);
});
Route::group(['middleware' => ['auth', 'permission:access.salas']], function() {
    Route::resource('salas', SalaController::class);
});
Route::group(['middleware' => ['auth', 'permission:access.cursos']], function() {
    Route::resource('cursos', CursoController::class);
});
Route::group(['middleware' => ['auth', 'permission:access.docentes']], function() {
    Route::resource('docentes', DocenteController::class);
});
Route::group(['middleware' => ['auth', 'permission:access.infantes_tutores']], function() {
    Route::resource('infantes-tutores', InfantesTutoreController::class);
});

// ==========================
// INSCRIPCIONES
// ==========================
Route::group(['middleware' => ['auth', 'permission:access.inscripciones']], function() {
    Route::resource('inscripciones', InscripcioneController::class);
});

// ==========================
// ASISTENCIAS
// ==========================
Route::group(['middleware' => ['auth', 'permission:access.asistencias']], function() {
    Route::get('asistencias/generar', [AsistenciaController::class, 'generarAsistencia'])
    ->name('asistencias.generarAsistencia');

Route::resource('asistencias', AsistenciaController::class);

});
Route::group(['middleware' => ['auth', 'permission:access.detalle_asistencias']], function() {
    Route::resource('detalle-asistencias', DetalleAsistenciaController::class);
});

// ==========================
// REPORTES
// ==========================
Route::group(['middleware' => ['auth', 'permission:access.reportes.lista_general']], function() {
    Route::get('reportes/inscritos', [ReporteController::class, 'vistaListaGeneral'])->name('reportes.lista_general');
    Route::get('reportes/inscritos/pdf', [ReporteController::class, 'listaGeneralPDF'])->name('reportes.lista_general_pdf');
});
Route::group(['middleware' => ['auth', 'permission:access.reportes.lista_filtrada']], function() {
    Route::get('reportes/inscritos/filtrar', [ReporteController::class, 'formFiltrar'])->name('reportes.form_filtrar');
    Route::get('reportes/inscritos/por-curso', [ReporteController::class, 'listaFiltradaPDF'])->name('reportes.lista_filtrada_pdf');
});
Route::group(['middleware' => ['auth', 'permission:access.reportes.asistencias']], function() {
    Route::get('reportes/asistencia/{asistencia}', [ReporteController::class, 'listaAsistenciaPDF'])->name('reportes.asistencia_pdf');
    Route::get('reportes/asistencias', [ReporteController::class, 'vistaAsistencias'])->name('reportes.asistencias');
});


// 1. Vista general donde se elige qué comprobante generar (NO requiere ID)
Route::get('/reportes/comprobante', 
    [ReporteController::class, 'comprobanteIndex']
)->name('reportes.comprobante_index');

// 2. Vista previa del comprobante (SÍ requiere ID)
Route::get('/reportes/comprobante/view/{inscripcion_id}', 
    [ReporteController::class, 'comprobanteView']
)->name('reportes.comprobante_view');

// 3. Generar PDF del comprobante (SÍ requiere ID)
Route::get('/reportes/comprobante/pdf/{inscripcion_id}', 
    [ReporteController::class, 'comprobante']
)->name('reportes.comprobante_pdf');





// ==========================
// VISTA TUTOR (solo Tutor)
// ==========================
Route::group(['middleware' => ['auth', 'permission:access.tutor_view']], function() {
    Route::get('tutor', [VistaTutorController::class, 'index'])
        ->name('tutor.vista');
});

Route::resource('model-has-roles', ModelHasRoleController::class);


