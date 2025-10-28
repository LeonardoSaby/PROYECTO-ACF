@extends('adminlte::page')

@section('title', 'Detalle de Asistencia')

@section('content_header')
    <h1>Detalle de Asistencia del Día</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-info">
                    <div class="card-header bg-info">
                        <h3 class="card-title">
                            <i class="fas fa-info-circle"></i> Información General
                        </h3>
                    </div>
                    <div class="card-body">
                        {{-- La variable $asistencia viene del controlador --}}
                        <div class="row">
                            <div class="col-md-4">
                                <strong>Fecha:</strong>
                                <p class="text-muted">{{ \Carbon\Carbon::parse($asistencia->fecha)->format('d/m/Y') }}</p>
                            </div>
                            <div class="col-md-4">
                                {{-- $referencia viene del controlador y es el primer detalle para obtener el Curso/Turno --}}
                                <strong>Curso:</strong>
                                <p class="text-muted">{{ $referencia->inscripcion->curso->nombre_curso ?? 'N/A' }}</p>
                            </div>
                            <div class="col-md-4">
                                <strong>Turno:</strong>
                                <p class="text-muted">{{ $referencia->inscripcion->turno->nombre_turno ?? 'N/A' }}</p>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-12">
                                <h4 class="mb-3"><i class="fas fa-users"></i> Lista de Infantes</h4>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>Infante</th>
                                                <th>Estado Asistencia</th>
                                                <th>Observaciones Adicionales</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            {{-- Iteramos sobre los detalles de la asistencia --}}
                                            @forelse ($asistencia->detalleAsistencias as $detalle)
                                                <tr>
                                                    <td>{{ $detalle->inscripcion->infante->nombre_infante }}</td>
                                                    <td>
                                                        @php
                                                            $badge = match($detalle->observaciones) {
                                                                'presente' => 'success',
                                                                'ausente' => 'danger',
                                                                'justificado' => 'warning',
                                                                default => 'secondary',
                                                            };
                                                        @endphp
                                                        <span class="badge badge-{{ $badge }}">
                                                            {{ ucfirst($detalle->observaciones) }}
                                                        </span>
                                                    </td>
                                                    <td>{{ $detalle->observaciones_adicionales ?? 'Sin observaciones' }}</td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="3" class="text-center">No se encontraron detalles para esta asistencia.</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('asistencias.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Volver al Historial
                        </a>
                        <a href="{{ route('asistencias.edit', $asistencia->id_asistencia) }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i> Editar Asistencia
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
