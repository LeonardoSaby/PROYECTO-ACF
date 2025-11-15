@extends('adminlte::page')

@section('title', 'Reporte de Asistencias')

@section('content')
<div class="container-fluid">

    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Asistencias Registradas</h4>
        </div>

        <div class="card-body">
            <table class="table table-striped table-bordered align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Fecha</th>
                        <th>Curso</th>
                        <th>Turno</th>
                        <th>Total de alumnos</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($asistencias as $asistencia)
                        <tr>
                            <td>{{ $asistencia->fecha }}</td>
                            <td>{{ $asistencia->detalleAsistencias->first()->inscripcion->curso->nombre_curso ?? 'N/A' }}</td>
                            <td>{{ $asistencia->detalleAsistencias->first()->inscripcion->turno->nombre_turno ?? 'N/A' }}</td>
                            <td>{{ $asistencia->detalleAsistencias->count() }}</td>
                            <td>
                                <a href="{{ route('reportes.asistencia_pdf', $asistencia->asistencia_id) }}" target="_blank" class="btn btn-primary btn-sm">
                                    <i class="fas fa-file-pdf"></i> Exportar PDF
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">No hay asistencias registradas</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
