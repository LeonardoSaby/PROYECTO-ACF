@extends('adminlte::page')

@section('template_title')
    Inscripciones
@endsection

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-sm-12">

            {{-- Card principal --}}
            <div class="card shadow-lg rounded-4">
                <div class="card-header bg-gradient-primary text-white d-flex flex-wrap justify-content-between align-items-center gap-2">
                    <h3 class="card-title mb-0"><i class="fas fa-file-alt"></i> Administrar Inscripciones</h3>

                    {{-- Botones y PDF --}}
                    <div class="d-flex gap-1 flex-wrap align-items-center">
{{-- BUSCADOR --}}
                        <form action="{{ route('inscripciones.index') }}" method="GET" class="d-flex">
                            <input
                                type="text"
                                name="search"
                                placeholder="Buscar..."
                                value="{{ request('search') }}"
                                class="form-control form-control-sm"
                                style="max-width: 180px;"
                            >
                            <button class="btn btn-light btn-sm ms-1" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </form>

                        {{-- Crear inscripción --}}
                        <a href="{{ route('inscripciones.create') }}" class="btn btn-success btn-sm">
                            <i class="fas fa-plus"></i> Registrar Inscripción
                        </a>

                    </div>
                </div>

                {{-- Mensaje de éxito --}}
                @if ($message = Session::get('success'))
                    <div class="alert alert-success m-4">
                        <p>{{ $message }}</p>
                    </div>
                @endif

                {{-- Tabla de inscripciones --}}
                <div class="card-body bg-light p-3">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover table-bordered align-middle text-center">
                            <thead class="table-primary">
                                <tr>
                                    <th>No</th>
                                    <th>Infante</th>
                                    <th>Curso</th>
                                    <th>Turno</th>
                                    <th>Fecha de registro</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($inscripciones as $index => $inscripcione)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $inscripcione->infante->nombre_infante }} {{ $inscripcione->infante->apellido_infante }}</td>
                                        <td>{{ $inscripcione->curso?->nombre_curso ?? 'Sin curso asignado' }}</td>
                                        <td>{{ $inscripcione->turno->nombre_turno }}</td>
                                        <td>{{ \Carbon\Carbon::parse($inscripcione->fecha)->format('d/m/Y') }}</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('inscripciones.edit', $inscripcione->inscripcion_id) }}" class="btn btn-sm btn-success">
                                                    <i class="fas fa-edit"></i> Editar
                                                </a>
                                                <form action="{{ route('inscripciones.destroy', $inscripcione->inscripcion_id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" onclick="event.preventDefault(); if(confirm('¿Estás seguro de eliminar esta inscripción?')) { this.closest('form').submit(); }">
                                                        <i class="fas fa-trash"></i> Eliminar
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- Paginación --}}
                <div class="card-footer d-flex justify-content-end">
                    {!! $inscripciones->withQueryString()->links() !!}
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
