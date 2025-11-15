@extends('adminlte::page')

@section('template_title')
    Turnos
@endsection

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-sm-12">

            {{-- Card principal --}}
            <div class="card shadow-lg rounded-4">
                <div class="card-header bg-gradient-primary text-white d-flex justify-content-between align-items-center">
                    <h3 class="card-title mb-0"><i class="fas fa-clock"></i> Administrar Turnos</h3>
                    <a href="{{ route('turnos.create') }}" class="btn btn-light btn-sm">
                        <i class="fas fa-plus"></i> Registrar Turno
                    </a>
                </div>

                @if ($message = Session::get('success'))
                    <div class="alert alert-success m-4">
                        <p>{{ $message }}</p>
                    </div>
                @endif

                <div class="card-body bg-light p-3">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover table-bordered align-middle">
                            <thead class="table-primary text-center">
                                <tr>
                                    <th>No</th>
                                    <th>Nombre</th>
                                    <th>Hora Inicio</th>
                                    <th>Hora Fin</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($turnos as $index => $turno)
                                    <tr class="text-center">
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $turno->nombre_turno }}</td>
                                        <td>{{ $turno->hora_inicio }}</td>
                                        <td>{{ $turno->hora_fin }}</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('turnos.edit', $turno->turno_id) }}" class="btn btn-sm btn-success">
                                                    <i class="fas fa-edit"></i> Editar
                                                </a>
                                                <form action="{{ route('turnos.destroy', $turno->turno_id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" onclick="event.preventDefault(); confirm('¿Está seguro de eliminar este turno?') ? this.closest('form').submit() : false;">
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

                <div class="card-footer d-flex justify-content-end">
                    {!! $turnos->withQueryString()->links() !!}
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
