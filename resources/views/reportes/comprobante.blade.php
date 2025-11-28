@extends('adminlte::page')

@section('title', 'Comprobantes de Inscripción')

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm">

        <div class="card-header bg-primary text-white d-flex justify-content-between">
            <h4 class="mb-0">Comprobantes de Inscripción</h4>

        </div>

        <div class="card-body">

            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Infante</th>
                        <th>Curso</th>
                        <th>Turno</th>
                        <th>Fecha</th>
                        <th>Comprobante</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($inscripciones as $inscripcion)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $inscripcion->infante->nombre_infante }} {{ $inscripcion->infante->apellido_infante }}</td>
                            <td>{{ $inscripcion->curso->nombre_curso ?? 'N/A' }}</td>
                            <td>{{ $inscripcion->turno->nombre_turno ?? 'N/A' }}</td>
                            <td>{{ $inscripcion->fecha }}</td>
                            
                            <td class="text-center">
                                <a href="{{ route('reportes.comprobante_pdf', $inscripcion->inscripcion_id) }}" 
                                   class="btn btn-sm btn-success" 
                                   target="_blank">
                                    <i class="fas fa-file-pdf"></i> Comprobante
                                </a>
                            </td>
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
