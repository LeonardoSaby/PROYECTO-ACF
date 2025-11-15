@extends('adminlte::page')

@section('template_title')
    Infantes
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card shadow-lg rounded-3">
                <div class="card-header bg-gradient-primary text-white d-flex justify-content-between align-items-center flex-wrap">
                    <h3 class="card-title mb-0"><i class="fas fa-baby"></i> Administrar Infantes</h3>

                    <div class="d-flex gap-2 flex-wrap">
                        <!-- Buscador -->
                        <form action="{{ route('infantes.index') }}" method="GET" class="d-flex">
                            <input type="text" name="search" class="form-control form-control-sm me-2"
                                placeholder="Buscar infante..." value="{{ request('search') }}">
                            <button type="submit" class="btn btn-sm btn-light"><i class="fas fa-search"></i></button>
                        </form>

                        <a href="{{ route('infantes.create') }}" class="btn btn-sm btn-success">
                            <i class="fas fa-plus"></i> Registrar Infante
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
                                    <th>Fecha Nacimiento</th>
                                    <th>Género</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($infantes as $infante)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        <td>{{ $infante->nombre_infante }}</td>
                                        <td>{{ $infante->apellido_infante }}</td>
                                        <td>{{ $infante->CI_infante }}</td>
                                        <td>{{ \Carbon\Carbon::parse($infante->fecha_nacimiento_infante)->format('d M Y') }}</td>
                                        <td>{{ $infante->genero_infante }}</td>
                                        
                                        <td>
                                            <div class="d-flex justify-content-center gap-1 flex-wrap">
                                                <!-- Ver -->
                                                <a class="btn btn-sm btn-info" href="{{ route('infantes.show', $infante->infante_id) }}">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                                
                                                <a class="btn btn-sm btn-success" href="{{ route('infantes.edit', $infante->infante_id) }}">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <form action="{{ route('infantes.destroy', $infante->infante_id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger"
                                                        onclick="event.preventDefault(); confirm('¿Desea eliminar este infante?') ? this.closest('form').submit() : false;">
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
                    {!! $infantes->withQueryString()->links() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
