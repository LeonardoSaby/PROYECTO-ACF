@extends('adminlte::page')

@section('title', 'Roles')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0">Roles</h3>
        <a href="{{ route('roles.create') }}" class="btn btn-primary">Registrar Rol</a>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">{{ $message }}</div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th style="width:50px;">No</th>
                            <th>Nombre</th>
                            <th>Permisos</th>
                            <th style="width:150px;">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($roles as $index => $role)
                        <tr>
                            <td>{{ $roles->firstItem() + $index }}</td>
                            <td>{{ $role->name }}</td>
                            <td>
    @forelse ($role->permissions as $perm)
        <span class="badge" style="background-color: #d0e7ff; color: #0a3d62;">{{ $perm->name }}</span>
    @empty
        <span class="text-muted">Sin permisos</span>
    @endforelse
</td>

                            <td>
                                <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-success btn-sm mb-1">Editar</a>
                                <form action="{{ route('roles.destroy', $role->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm mb-1"
                                        onclick="return confirm('¿Seguro que desea eliminar este rol?')">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card-footer d-flex justify-content-end">
            {!! $roles->links() !!}
        </div>
    </div>
</div>
@endsection
