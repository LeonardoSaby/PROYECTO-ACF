@extends('adminlte::page')

@section('title', 'Historial de Asistencias')

@section('content_header')
    <h1>Historial de Asistencias</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Listado de Asistencias Registradas</h3>
            <div class="card-tools">
                <a href="{{ route('asistencias.create') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus"></i> Nueva Asistencia
                </a>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>Fecha</th>
                            <th>Registrado</th>
                            <th>Estado Lógico</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- La variable $asistencias debe venir del controlador --}}
                        @forelse ($asistencias as $asistencia)
                            <tr>
                                <td>{{ $asistencia->id_asistencia }}</td>
                                <td>{{ \Carbon\Carbon::parse($asistencia->fecha)->format('d/m/Y') }}</td>
                                <td>{{ $asistencia->created_at->diffForHumans() }}</td>
                                <td>
                                    <span class="badge badge-{{ $asistencia->status == 'activo' ? 'success' : 'danger' }}">
                                        {{ ucfirst($asistencia->status) }}
                                    </span>
                                </td>
                                <td>
                                    <form action="{{ route('asistencias.destroy', $asistencia->id_asistencia) }}" method="POST">
                                        {{-- Botón para ver los detalles (la lista de infantes) --}}
                                        <a class="btn btn-sm btn-info" href="{{ route('asistencias.show', $asistencia->id_asistencia) }}">
                                            <i class="fa fa-fw fa-eye"></i> Ver
                                        </a>
                                        {{-- Botón para editar la asistencia --}}
                                        <a class="btn btn-sm btn-warning" href="{{ route('asistencias.edit', $asistencia->id_asistencia) }}">
                                            <i class="fa fa-fw fa-edit"></i> Editar
                                        </a>
                                        {{-- Botón de eliminación lógica --}}
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Está seguro de cambiar el estado a inactivo?')">
                                            <i class="fa fa-fw fa-trash"></i> Borrar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">No hay registros de asistencias disponibles.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
