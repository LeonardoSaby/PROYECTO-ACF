@extends('adminlte::page')

@section('title', 'Gestión de Roles')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="mb-0">
            <i class="fas fa-user-shield text-primary me-2"></i> Gestión de Roles
        </h1>
        <a href="{{ route('roles.create') }}" class="btn btn-primary">
            <i class="fas fa-plus-circle"></i> Crear Nuevo Rol
        </a>
    </div>
@stop

@section('content')
<div class="card shadow">
    <div class="card-header bg-light">
        <h5 class="mb-0 text-primary">
            <i class="fas fa-users-cog me-2"></i> Listado de Roles y Permisos Asignados
        </h5>
    </div>

    <div class="card-body">
        {{-- Mensaje de éxito --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
            </div>
        @endif

        {{-- Tabla de roles --}}
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th width="5%">#</th>
                    <th>Rol</th>
                    <th width="60%">Permisos Asignados</th>
                    <th width="20%" class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($roles as $rol)
                    <tr>
                        <td>{{ $loop->iteration + ($roles->currentPage() - 1) * $roles->perPage() }}</td>
                        <td class="fw-semibold">
                            <i class="fas fa-user-tag text-secondary me-1"></i> {{ ucfirst($rol->name) }}
                        </td>
                        <td>
                            @if ($rol->permissions->count())
                                <div class="row">
                                    @foreach ($rol->permissions as $permiso)
                                        <div class="col-md-4">
                                            <div class="form-check">
                                                <input type="checkbox" checked disabled class="form-check-input">
                                                <label class="form-check-label text-muted">
                                                    <i class="fas fa-key text-warning me-1"></i>
                                                    {{ ucfirst($permiso->name) }}
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <span class="text-muted">—</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <a href="{{ route('roles.show', $rol->id) }}" class="btn btn-sm btn-primary">
                                <i class="fas fa-eye"></i> Mostrar
                            </a>
                            <a href="{{ route('roles.edit', $rol->id) }}" class="btn btn-sm btn-success">
                                <i class="fas fa-edit"></i> Editar
                            </a>
                            <form action="{{ route('roles.destroy', $rol->id) }}" method="POST" style="display:inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"
                                    onclick="return confirm('¿Deseas eliminar este rol?')">
                                    <i class="fas fa-trash-alt"></i> Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted">No hay roles registrados.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{-- Paginación --}}
        <div class="d-flex justify-content-end mt-3">
            {{ $roles->links() }}
        </div>
    </div>
</div>
@stop