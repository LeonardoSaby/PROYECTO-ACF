@extends('adminlte::page')

@section('template_title')
    {{ isset($role) ? 'Editar Rol' : 'Crear Rol' }}
@endsection

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h3 class="card-title mb-0">{{ isset($role) ? 'Editar Rol' : 'Crear Rol' }}</h3>
        </div>
        <div class="card-body">
            <form action="{{ isset($role) ? route('roles.update', $role->id) : route('roles.store') }}" method="POST">
                @csrf
                @if(isset($role))
                    @method('PUT')
                @endif

                <!-- Nombre del rol -->
                <div class="mb-4">
                    <label for="name" class="form-label fw-bold">Nombre del rol</label>
                    <input type="text" name="name" id="name" class="form-control form-control-lg" 
                           placeholder="Ingrese el nombre del rol"
                           value="{{ old('name', $role->name ?? '') }}" required>
                </div>

                <!-- Permisos -->
                <div class="mb-4">
                    <label class="form-label fw-bold">Permisos</label>
                    <div class="row g-3">
                        @foreach($permissions as $permission)
                            <div class="col-md-4">
                                <div class="form-check p-3 permission-card {{ in_array($permission->name, old('permissions', $rolePermissions)) ? 'selected' : '' }}">
                                    <input class="form-check-input" type="checkbox" name="permissions[]" 
                                           value="{{ $permission->name }}" 
                                           id="perm_{{ $permission->name }}"
                                           {{ in_array($permission->name, old('permissions', $rolePermissions)) ? 'checked' : '' }}>
                                    <label class="form-check-label fw-normal" for="perm_{{ $permission->name }}">
                                        {{ $permission->name }}
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="d-flex justify-content-end">
                    <a href="{{ route('roles.index') }}" class="btn btn-outline-secondary me-2">Cancelar</a>
                    <button type="submit" class="btn btn-success">{{ isset($role) ? 'Actualizar' : 'Guardar' }}</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
.permission-card {
    background-color: #f0f4f7; /* color suave de fondo */
    border: 1px solid #d1d7dc;
    border-radius: 0.5rem;
    transition: all 0.2s;
    cursor: pointer;
}
.permission-card:hover {
    background-color: #e2eaf1;
    box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.1);
}
.permission-card input.form-check-input {
    cursor: pointer;
}
.permission-card.selected {
    background-color: #cfe2ff; /* azul suave cuando está seleccionado */
    border-color: #66afe9;
}
</style>
@endsection
