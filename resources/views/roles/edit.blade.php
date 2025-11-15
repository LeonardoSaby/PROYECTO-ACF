@extends('adminlte::page')

@section('template_title')
    Editar Rol
@endsection

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">{{ __('Editar Rol') }}</div>
        <div class="card-body">
            <form action="{{ route('roles.update', $role->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Nombre del rol -->
                <div class="form-group mb-3">
                    <label for="name">Nombre</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $role->name) }}" required>
                    {!! $errors->first('name', '<div class="invalid-feedback"><strong>:message</strong></div>') !!}
                </div>

                <!-- Permisos -->
                <div class="form-group mb-3">
                    <label>Permisos</label>
                    <div class="d-flex flex-wrap">
                        @foreach($permissions as $permission)
                        <div class="form-check me-2 mb-2">
                            <input type="checkbox" name="permissions[]" value="{{ $permission->id }}" id="perm-{{ $permission->id }}" 
                                class="form-check-input"
                                {{ in_array($permission->id, $rolePermissions) ? 'checked' : '' }}>
                            <label class="form-check-label btn btn-outline-primary btn-sm rounded-pill" for="perm-{{ $permission->id }}">{{ $permission->name }}</label>
                        </div>
                        @endforeach
                    </div>
                    {!! $errors->first('permissions', '<div class="invalid-feedback d-block"><strong>:message</strong></div>') !!}
                </div>

                <button type="submit" class="btn btn-primary">Actualizar</button>
                <a href="{{ route('roles.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
</div>
@endsection
