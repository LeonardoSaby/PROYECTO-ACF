@extends('adminlte::page')

@section('title', 'Asistencias')

@section('content')

<div class="container-fluid">

    {{-- Toast centrado para errores o advertencias --}}
    @if(session('error') || session('warning'))
        <div id="toast-message" class="position-fixed top-50 start-50 translate-middle" style="z-index: 1055; min-width: 300px;">
            <div class="toast align-items-center text-white {{ session('error') ? 'bg-danger' : 'bg-primary' }} border-0 show" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body text-center">
                        {{ session('error') ?? session('warning') ?? 'Ya se generó la lista de asistencia para este curso y turno.' }}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Registro de Asistencias</h4>
        </div>

        <div class="card-body">
            <form action="{{ route('asistencias.generarAsistencia') }}" method="GET" class="row g-3 align-items-end">
                <div class="col-md-3">
                    <label class="form-label">Fecha:</label>
                    <input type="date" name="fecha" class="form-control" value="{{ now()->format('Y-m-d') }}" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Curso:</label>
                    <select name="curso_id" class="form-control" required>
                        <option value="">Seleccione</option>
                        @foreach($cursos as $curso)
                            <option value="{{ $curso->curso_id }}">{{ $curso->nombre_curso }}</option>
                        @endforeach
                    </select>
                </div>  
                <div class="col-md-4">
                    <label class="form-label">Turno:</label>
                    <select name="turno_id" class="form-control" required>
                        <option value="">Seleccione</option>
                        @foreach($turnos as $turno)
                            <option value="{{ $turno->turno_id }}">{{ $turno->nombre_turno }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-1 d-flex">
                    <button type="submit" class="btn btn-success w-100">
                        <i class="fas fa-check"></i> Generar
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Tabla de asistencias registradas --}}
    <div class="card mt-4 shadow-sm">
        <div class="card-header bg-secondary text-white">
            <h5 class="mb-0">Asistencias registradas</h5>
        </div>
        <div class="card-body">
            <table class="table table-striped table-bordered align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Fecha</th>
                        <th>Curso</th>
                        <th>Turno</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($asistencias as $asistencia)
                        <tr>
                            <td>{{ $asistencia->fecha }}</td>
                            <td>{{ $asistencia->detalleAsistencias->first()->inscripcion->curso->nombre_curso ?? 'N/A' }}</td>
                            <td>{{ $asistencia->detalleAsistencias->first()->inscripcion->turno->nombre_turno ?? 'N/A' }}</td>
                            <td class="text-center">
                                <a href="{{ route('asistencias.show', $asistencia->asistencia_id) }}" class="btn btn-info btn-sm">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">No hay asistencias registradas</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

{{-- Script para ocultar el toast después de 5 segundos --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const toastEl = document.getElementById('toast-message');
        if (toastEl) {
            setTimeout(() => {
                toastEl.classList.remove('show');
                toastEl.style.display = 'none';
            }, 5000); // 5 segundos
        }
    });
</script>

@endsection
