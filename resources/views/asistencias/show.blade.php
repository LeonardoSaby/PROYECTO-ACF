@extends('adminlte::page')

@section('title', 'Detalles de Asistencia')

@section('content')
<div class="container">
    <div class="card shadow-lg border-0 rounded-3">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h3 class="mb-0">Detalles de Asistencia</h3>
            <a href="{{ route('asistencias.index') }}" class="btn btn-secondary btn-sm">
                <i class="fas fa-arrow-left"></i> Volver
            </a>
        </div>

        <div class="card-body">
            <p><strong>📅 Fecha:</strong> {{ $asistencia->fecha }}</p>

            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-primary text-center">
                        <tr>
                            <th>Infante</th>
                            <th>Curso</th>
                            <th>Turno</th>
                            <th>Observación</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($asistencia->detalleAsistencias as $detalle)
                            <tr>
                                <td>{{ $detalle->inscripcion->infante->nombre_infante }} {{ $detalle->inscripcion->infante->apellido_infante }}</td>
                                <td>{{ $detalle->inscripcion->curso->nombre_curso }}</td>
                                <td>{{ $detalle->inscripcion->turno->nombre_turno }}</td>
                                <td class="text-center">
                                    @if ($detalle->observacion == 'presente')
                                        <span class="badge bg-success px-3 py-2">Presente</span>
                                    @elseif ($detalle->observacion == 'ausente')
                                        <span class="badge bg-danger px-3 py-2">Ausente</span>
                                    @else
                                        <span class="badge bg-secondary px-3 py-2">N/A</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted">No se encontraron registros de asistencia</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
