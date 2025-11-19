@extends('adminlte::page')

@section('title', 'Panel del Tutor')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="text-primary fw-bold"><i class="fas fa-chalkboard-teacher"></i> Panel del Tutor</h1>
    </div>
@stop

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
            <div class="card shadow-lg rounded-3 border-0">
                <div class="card-header bg-gradient-primary text-white">
                    <h3 class="card-title mb-0"><i class="fas fa-user"></i> Información del Tutor</h3>
                </div>
                <div class="card-body bg-white">
                    <div class="text-center mb-4">
                        <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                            <i class="fas fa-user-tie fa-3x text-primary"></i>
                        </div>
                        <h4 class="mt-2 text-primary">{{ $tutor->nombre_tutor }} {{ $tutor->apellido_tutor }}</h4>
                        <span class="badge bg-primary">Tutor Responsable</span>
                    </div>
                    
                    <hr class="my-3">

                    <div class="d-flex flex-column gap-2">
                        <p class="mb-2"><i class="fas fa-id-card text-primary me-2" style="width:20px;"></i> <strong>CI:</strong> {{ $tutor->CI_tutor }}</p>
                        <p class="mb-2"><i class="fas fa-phone text-primary me-2" style="width:20px;"></i> <strong>Teléfono:</strong> {{ $tutor->telefono_tutor }}</p>
                        <p class="mb-2"><i class="fas fa-envelope text-primary me-2" style="width:20px;"></i> <strong>Correo:</strong> {{ $tutor->correo_electronico_tutor }}</p>
                        <p class="mb-0"><i class="fas fa-map-marker-alt text-primary me-2" style="width:20px;"></i> <strong>Dirección:</strong> {{ $tutor->direccion_tutor }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            
            <div class="card shadow-lg rounded-3 border-0 mb-4">
                <div class="card-header bg-gradient-primary text-white">
                    <h3 class="card-title mb-0"><i class="fas fa-child"></i> Infantes a su cargo</h3>
                </div>
                <div class="card-body bg-white">
                    @if($tutor->infantes->isEmpty())
                        <div class="alert alert-light text-center border text-muted">
                            <i class="fas fa-info-circle fa-2x mb-2"></i><br>
                            No hay infantes asignados actualmente.
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered align-middle">
                                <thead class="table-primary text-center">
                                    <tr>
                                        <th>#</th>
                                        <th>Nombre Completo</th>
                                        <th>CI</th>
                                        <th>Género</th>
                                        <th>Edad</th>
                                        <th>Parentesco</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($tutor->infantes as $infante)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td>{{ $infante->nombre_infante }} {{ $infante->apellido_infante }}</td>
                                            <td class="text-center">{{ $infante->CI_infante }}</td>
                                            <td class="text-center">{{ $infante->genero_infante }}</td>
                                            <td class="text-center">
                                                {{ \Carbon\Carbon::parse($infante->fecha_nacimiento_infante)->age }} años
                                            </td>
                                            <td class="text-center">
                                                <span class="badge bg-primary">{{ $infante->pivot->parentesco }}</span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>

            <div class="card shadow-lg rounded-3 border-0">
                <div class="card-header bg-white text-primary border-bottom border-primary">
                    <h3 class="card-title mb-0"><i class="fas fa-book-reader"></i> Historial de Asistencias</h3>
                </div>
                <div class="card-body">
                    @forelse($tutor->infantes as $infante)
                        <div class="mb-4 p-3 rounded bg-light border">
                            <h5 class="text-primary border-bottom pb-2 mb-3">
                                <i class="fas fa-user-graduate"></i> {{ $infante->nombre_infante }} {{ $infante->apellido_infante }}
                            </h5>

                            @if($infante->inscripciones->isEmpty())
                                <p class="text-muted fst-italic ms-3">No registra inscripciones activas.</p>
                            @else
                                <div class="table-responsive">
                                    <table class="table table-sm table-bordered bg-white">
                                        <thead class="table-primary">
                                            <tr>
                                                <th>Curso</th>
                                                <th>Turno</th>
                                                <th>Fecha de inscripcion</th>
                                                <th style="width: 40%;">Historial de Asistencias</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($infante->inscripciones as $inscripcion)
                                            <tr>
                                                <td>{{ $inscripcion->curso->nombre_curso ?? 'N/A' }}</td>
                                                <td>{{ $inscripcion->turno->nombre_turno ?? 'N/A' }}</td>
                                                <td>{{ \Carbon\Carbon::parse($inscripcion->fecha)->format('d/m/Y') }}</td>
                                                <td>
                                                    @if($inscripcion->detalleAsistencias->isEmpty())
                                                        <span class="text-muted small">Sin registros</span>
                                                    @else
                                                        <div class="d-flex flex-wrap gap-1">
                                                            @foreach($inscripcion->detalleAsistencias as $detalle)
                                                                {{-- Lógica de colores --}}
                                                                @php
                                                                    // Normalizamos el texto a minúsculas para comparar
                                                                    $estado = strtolower($detalle->observacion);
                                                                    
                                                                    // Definimos el color y el icono según el estado
                                                                    if ($estado == 'presente' || $estado == 'asistio') {
                                                                        $badgeColor = 'bg-success'; // Verde
                                                                        $icon = 'fa-check-circle';
                                                                    } else {
                                                                        $badgeColor = 'bg-danger'; // Rojo (Ausente, Falta, Licencia)
                                                                        $icon = 'fa-times-circle';
                                                                    }
                                                                @endphp

                                                                <span class="badge {{ $badgeColor }} p-2 mb-1">
                                                                    <i class="fas {{ $icon }} me-1"></i>
                                                                    {{ \Carbon\Carbon::parse($detalle->asistencia->fecha)->format('d/m') }} 
                                                                    - 
                                                                    {{ ucfirst($detalle->observacion) }}
                                                                </span>
                                                            @endforeach
                                                        </div>
                                                    @endif
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        </div>
                    @empty
                        <p class="text-center text-muted">Sin información para mostrar.</p>
                    @endforelse
                </div>
            </div>

        </div>
    </div>
</div>
@stop

@section('css')
<style>
    .card {
        border-radius: 0.75rem !important;
    }
    .card-header {
        border-top-left-radius: 0.75rem !important;
        border-top-right-radius: 0.75rem !important;
    }
    .table-hover tbody tr:hover {
        background-color: #eaf4fc;
    }
</style>
@stop