@extends('adminlte::page')

@section('title', 'Lista general de inscritos')

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Lista General de Inscritos</h4>
        </div>
        <div class="card-body">
            <a href="{{ route('reportes.lista_general_pdf') }}" class="btn btn-primary mb-3" target="_blank" >
                <i class="fas fa-file-pdf"></i> Exportar PDF
            </a>


            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Nombre Infante</th>
                        <th>Apellido Infante</th>
                        <th>Curso</th>
                        <th>Turno</th>
                        <th>Fecha de inscripción</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($inscritos as $inscripcion)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $inscripcion->infante->nombre_infante }}</td>
                            <td>{{ $inscripcion->infante->apellido_infante }}</td>
                            <td>{{ $inscripcion->curso->nombre_curso ?? 'N/A' }}</td>
                            <td>{{ $inscripcion->turno->nombre_turno ?? 'N/A' }}</td>
                            <td>{{ $inscripcion->fecha }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">No hay inscritos</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
