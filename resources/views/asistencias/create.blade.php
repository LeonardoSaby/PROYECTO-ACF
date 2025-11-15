@extends('adminlte::page')

@section('title', 'Marcar Asistencia')

@section('content')
<div class="container">
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-header bg-primary text-white text-center rounded-top-4">
            <h4 class="mb-0">Registro de Asistencia</h4>
        </div>

        <div class="card-body p-4">
            <p><strong>Fecha:</strong> {{ \Carbon\Carbon::parse($fecha)->format('d/m/Y') }}</p>
            <p><strong>Curso:</strong> {{ $curso->nombre_curso }}</p>
            <p><strong>Turno:</strong> {{ $turno->nombre_turno }}</p>

            <form action="{{ route('asistencias.store') }}" method="POST">
                @csrf
                <input type="hidden" name="fecha" value="{{ $fecha }}">
                <input type="hidden" name="curso_id" value="{{ $curso->curso_id }}">
                <input type="hidden" name="turno_id" value="{{ $turno->turno_id }}">

                <div class="table-responsive">
                    <table class="table table-hover align-middle text-center">
                        <thead class="table-primary">
                            <tr>
                                <th>Infante</th>
                                <th>Presente</th>
                                <th>Ausente</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($inscripciones as $inscripcion)
                                <tr>
                                    <td class="text-start">
                                        <strong>{{ $inscripcion->infante->nombre_infante }} {{ $inscripcion->infante->apellido_infante }}</strong>
                                    </td>
                                    <td>
                                        <input type="radio" name="detalles[{{ $inscripcion->inscripcion_id }}]" value="presente" required>
                                    </td>
                                    <td>
                                        <input type="radio" name="detalles[{{ $inscripcion->inscripcion_id }}]" value="ausente">
                                    </td>
                                    
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-success px-4 rounded-pill shadow-sm">
                        <i class="fas fa-save"></i> Guardar Asistencia
                    </button>
                    <a href="{{ route('asistencias.index') }}" class="btn btn-secondary px-4 rounded-pill shadow-sm">
                        <i class="fas fa-arrow-left"></i> Volver
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    input[type="radio"] {
        transform: scale(1.3);
        accent-color: #007bff;
        cursor: pointer;
    }

    th, td {
        vertical-align: middle !important;
    }

    .table-hover tbody tr:hover {
        background-color: #f0f8ff;
    }

    .card {
        border-radius: 1rem;
    }
</style>
@endsection
