<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\LoginApiController;
use App\Http\Controllers\Api\UserApiController;
use App\Http\Controllers\Api\TutoreApiController;
use App\Http\Controllers\Api\InfanteApiController;
use App\Http\Controllers\Api\InfanteTutoreApiController;
use App\Http\Controllers\Api\TurnoApiController;
use App\Http\Controllers\Api\SalaApiController;
use App\Http\Controllers\Api\NivelApiController;
use App\Http\Controllers\Api\CursoApiController;
use App\Http\Controllers\Api\DocenteApiController;
use App\Http\Controllers\Api\InscripcioneApiController;
use App\Http\Controllers\Api\AsistenciaApiController;
use App\Http\Controllers\Api\DetalleAsistenciaApiController;
// --------------------------------------------------------------------------
// RUTAS PÚBLICAS (No requieren Token)
// --------------------------------------------------------------------------
// El login debe ser público para obtener el token.
Route::post('/login', [LoginApiController::class, 'login']); 
// --------------------------------------------------------------------------
// RUTAS PROTEGIDAS (Requieren Token: auth:sanctum)
// --------------------------------------------------------------------------
// Agrupamos todas las rutas de recursos y el logout dentro de la protección
Route::middleware('auth:sanctum')->group(function () {
    
    // Obtener información del usuario autenticado
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // Cerrar sesión
    Route::post('/logout', [LoginApiController::class, 'logout']);

    // RUTAS DE RECURSOS (CRUD API Resources)
    Route::apiResource('users', UserApiController::class);
    Route::apiResource('tutores', TutoreApiController::class);
    Route::apiResource('infantes', InfanteApiController::class);
    Route::apiResource('infantes-tutores', InfanteTutoreApiController::class);
    Route::apiResource('turnos', TurnoApiController::class);
    Route::apiResource('salas', SalaApiController::class);
    Route::apiResource('niveles', NivelApiController::class);
    Route::apiResource('cursos', CursoApiController::class);
    Route::apiResource('docentes', DocenteApiController::class);
    Route::apiResource('inscripciones', InscripcioneApiController::class);
    Route::apiResource('asistencias', AsistenciaApiController::class);
    Route::apiResource('detalle-asistencias', DetalleAsistenciaApiController::class);

});