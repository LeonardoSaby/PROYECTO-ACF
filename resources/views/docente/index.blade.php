@extends('adminlte::page')

@section('template_title')
    Docentes
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card shadow-lg rounded-3">
                <div class="card-header bg-gradient-primary text-white d-flex justify-content-between align-items-center flex-wrap">
                    <h3 class="card-title mb-0"><i class="fas fa-chalkboard-teacher"></i> Administrar Docentes</h3>

                    <div class="d-flex gap-2 flex-wrap">
                        <form action="{{ route('docentes.index') }}" method="GET" class="d-flex gap-1">
                            <input type="text" name="search" class="form-control form-control-sm" placeholder="Buscar docente..." value="{{ request('search') }}">
                            <button type="submit" class="btn btn-sm btn-light"><i class="fas fa-search"></i></button>
                        </form>

                        <a href="{{ route('docentes.create') }}" class="btn btn-sm btn-success">
                            <i class="fas fa-plus"></i> Registrar Docente
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
                                    <th>Fecha Contratación</th>
                                    <th>Curso</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($docentes as $docente)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        <td>{{ $docente->nombre_docente }}</td>
                                        <td>{{ $docente->apellido_docente }}</td>
                                        <td>{{ $docente->fecha_contratacion }}</td>
                                        <td>{{ $docente->curso->nombre_curso ?? 'Sin curso asignado' }}</td>
                                        <td>
                                            <div class="d-flex justify-content-center gap-1 flex-wrap">
                                                <!-- Ver docente -->
                                                <a class="btn btn-sm btn-primary" href="{{ route('docentes.show', $docente) }}">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                                <a class="btn btn-sm btn-success" href="{{ route('docentes.edit', $docente) }}">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <form action="{{ route('docentes.destroy', $docente) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger"
                                                        onclick="event.preventDefault(); 
                                                                confirm('¿Desea eliminar este docente?') ? this.closest('form').submit() : false;">
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
                    {!! $docentes->withQueryString()->links() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
