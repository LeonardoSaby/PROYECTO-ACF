@extends('adminlte::page')

@section('title', 'Editar Asistencia')

@section('content')
<div class="container">
    <div class="card shadow-lg border-0 rounded-3">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h3 class="mb-0">Editar Asistencia</h3>
            <a href="{{ route('asistencias.index') }}" class="btn btn-secondary btn-sm">
                <i class="fas fa-arrow-left"></i> Volver
            </a>
        </div>

        <div class="card-body">
            <p><strong>📅 Fecha:</strong> {{ $asistencia->fecha }}</p>

            <form action="{{ route('asistencias.update', $asistencia->asistencia_id) }}" method="POST">
                @csrf
                @method('PUT')

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
                            @foreach ($asistencia->detalleAsistencias as $detalle)
                                <tr>
                                    <td>{{ $detalle->inscripcion->infante->nombre_infante }} {{ $detalle->inscripcion->infante->apellido_infante }}</td>
                                    <td>{{ $detalle->inscripcion->curso->nombre_curso }}</td>
                                    <td>{{ $detalle->inscripcion->turno->nombre_turno }}</td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-3">
                                            <label class="form-check-label">
                                                <input type="radio" name="observaciones[{{ $detalle->detalle_asistencia_id }}]" value="presente"
                                                    class="form-check-input" {{ $detalle->observacion == 'presente' ? 'checked' : '' }}>
                                                <span class="badge bg-success">Presente</span>
                                            </label>
                                            <label class="form-check-label">
                                                <input type="radio" name="observaciones[{{ $detalle->detalle_asistencia_id }}]" value="ausente"
                                                    class="form-check-input" {{ $detalle->observacion == 'ausente' ? 'checked' : '' }}>
                                                <span class="badge bg-danger">Ausente</span>
                                            </label>
                                            
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="text-end mt-3">
                    <button type="submit" class="btn btn-success px-4">
                        <i class="fas fa-save"></i> Actualizar Asistencia
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
