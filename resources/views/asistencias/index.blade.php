@extends('adminlte::page')

@section('title', 'Asistencias')

@section('content')
<div class="container-fluid">

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
                                <!--<a href="{{ route('asistencias.edit', $asistencia->asistencia_id) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('asistencias.destroy', $asistencia->asistencia_id) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar asistencia?')">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>-->
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
@endsection
