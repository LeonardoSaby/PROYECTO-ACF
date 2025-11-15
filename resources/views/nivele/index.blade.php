@extends('adminlte::page')

@section('template_title')
    Niveles
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card shadow-lg rounded-3">
                <div class="card-header bg-gradient-primary text-white d-flex justify-content-between align-items-center flex-wrap">
                    <h3 class="card-title mb-0"><i class="fas fa-layer-group"></i> Administrar Niveles</h3>

                    <div class="d-flex gap-2 flex-wrap">
                        <a href="{{ route('niveles.create') }}" class="btn btn-sm btn-success">
                            <i class="fas fa-plus"></i> Registrar Nivel
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
                                    <th>Nombre Nivel</th>
                                    <th>Edad Mínima</th>
                                    <th>Edad Máxima</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($niveles as $nivele)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        <td>{{ $nivele->nombre_nivel }}</td>
                                        <td>{{ $nivele->edad_minima }} años</td>
                                        <td>{{ $nivele->edad_maxima }} años</td>
                                        
                                        <td>
                                            <div class="d-flex justify-content-center gap-1 flex-wrap">
                                                <a class="btn btn-sm btn-success" href="{{ route('niveles.edit', $nivele->nivel_id) }}">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <form action="{{ route('niveles.destroy', $nivele->nivel_id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger"
                                                        onclick="event.preventDefault(); confirm('¿Desea eliminar este nivel?') ? this.closest('form').submit() : false;">
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
                    {!! $niveles->withQueryString()->links() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
