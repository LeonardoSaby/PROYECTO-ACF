@extends('adminlte::page')

@section('title', 'Usuarios')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card shadow-lg rounded-3">
                {{-- Encabezado --}}
                <div class="card-header bg-gradient-primary text-white d-flex justify-content-between align-items-center flex-wrap">
                    {{-- Título --}}
                    <h3 class="card-title mb-0"><i class="fas fa-users"></i> Administrar Usuarios</h3>

                    {{-- Buscador --}}
                    <form action="{{ route('users.index') }}" method="GET" class="d-flex gap-2" style="width: 250px;">
        <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Buscar por nombre o email" class="form-control form-control-sm" />
        <button type="submit" class="btn btn-light btn-sm"><i class="fas fa-search"></i></button>
    </form>

                    {{-- Botón de registrar --}}
                    <div class="d-flex gap-1">
                        <a href="{{ route('users.create') }}" class="btn btn-sm btn-success">
                            <i class="fas fa-plus"></i> Registrar Usuario
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
                                    <th>Email</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            <div class="d-flex justify-content-center gap-1 flex-wrap">
                                                <a class="btn btn-sm btn-success" href="{{ route('users.edit', $user->id) }}">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger"
                                                        onclick="event.preventDefault(); confirm('¿Seguro que desea eliminar este usuario?') ? this.closest('form').submit() : false;">
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
                    {!! $users->withQueryString()->links() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
