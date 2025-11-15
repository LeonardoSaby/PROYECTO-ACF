@extends('adminlte::page')

@section('template_title')
    Tutores
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card shadow-lg rounded-3">
                <div class="card-header bg-gradient-primary text-white d-flex justify-content-between align-items-center flex-wrap">
                    <h3 class="card-title mb-0"><i class="fas fa-users"></i> Administrar Tutores</h3>

                    <div class="d-flex gap-2 flex-wrap">
                        <form action="{{ route('tutores.index') }}" method="GET" class="d-flex">
                            <input type="text" name="search" class="form-control form-control-sm me-2"
                                placeholder="Buscar tutor..." value="{{ request('search') }}">
                            <button type="submit" class="btn btn-sm btn-light"><i class="fas fa-search"></i></button>
                        </form>

                        <a href="{{ route('tutores.create') }}" class="btn btn-sm btn-success">
                            <i class="fas fa-plus"></i> Registrar Tutor
                        </a>
                    </div>
                </div>

                @if ($message = Session::get('success'))
                    <div class="alert alert-success m-4">
                        <p>{{ $message }}</p>
                    </div>
                @endif

                <div class="card-body bg-white">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover table-bordered align-middle text-center">
                            <thead class="table-primary">
                                <tr>
                                    <th>No</th>
                                    <th>Nombre</th>
                                    <th>Apellido</th>
                                    <th>CI</th>
                                    <th>Teléfono</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tutores as $tutore)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        <td>{{ $tutore->nombre_tutor }}</td>
                                        <td>{{ $tutore->apellido_tutor }}</td>
                                        <td>{{ $tutore->CI_tutor }}</td>
                                        <td>{{ $tutore->telefono_tutor }}</td>
                                        <td>
                                            <div class="d-flex justify-content-center gap-1 flex-wrap">
                                                <a class="btn btn-sm btn-primary" href="{{ route('tutores.show', $tutore->tutor_id) }}">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                                <a class="btn btn-sm btn-success" href="{{ route('tutores.edit', $tutore->tutor_id) }}">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <form action="{{ route('tutores.destroy', $tutore->tutor_id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger"
                                                        onclick="event.preventDefault(); confirm('¿Desea eliminar este tutor?') ? this.closest('form').submit() : false;">
                                                        <i class="fa fa-trash"></i>
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

                <div class="card-footer clearfix">
                    {!! $tutores->withQueryString()->links() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
