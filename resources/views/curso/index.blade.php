@extends('adminlte::page')

@section('template_title')
    Cursos
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card shadow-lg rounded-3">
                {{-- Cambio de color aquí: bg-gradient-primary --}}
                <div class="card-header bg-gradient-primary text-white d-flex justify-content-between align-items-center flex-wrap">
                    <h3 class="card-title mb-0"><i class="fas fa-book"></i> Administrar Cursos</h3>

                    <div class="d-flex gap-2 flex-wrap">
                        <a href="{{ route('cursos.create') }}" class="btn btn-sm btn-success">
                            <i class="fas fa-plus"></i> Registrar Curso
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
                            {{-- Cambio de color aquí: table-primary --}}
                            <thead class="table-primary">
                                <tr>
                                    <th>No</th>
                                    <th>Nombre</th>
                                    <th>Sala</th>
                                    <th>Edad Mínima</th>
                                    <th>Edad Máxima</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cursos as $curso)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        <td>{{ $curso->nombre_curso }}</td>
                                        <td>{{ $curso->sala->nombre_sala }}</td>
                                        <td>{{ $curso->nivel?->edad_minima }} años</td>
                                        <td>{{ $curso->nivel?->edad_maxima }} años</td>

                                        <td>
                                            <div class="d-flex justify-content-center gap-1 flex-wrap">
                                                <a class="btn btn-sm btn-success" href="{{ route('cursos.edit', $curso->curso_id) }}">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <form action="{{ route('cursos.destroy', $curso->curso_id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger"
                                                        onclick="event.preventDefault(); confirm('¿Desea eliminar este curso?') ? this.closest('form').submit() : false;">
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
                    {!! $cursos->withQueryString()->links() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection