@extends('adminlte::page')

@section('template_title')
    Crear Rol
@endsection

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">{{ __('Crear Rol') }}</div>
        <div class="card-body">
            <form action="{{ route('roles.store') }}" method="POST">
    @csrf

    <!-- Nombre del rol -->
    <div class="form-group">
        <label for="name">Nombre del rol</label>
        <input type="text" name="name" id="name" class="form-control" required>
    </div>

    <!-- Permisos -->
    <div class="form-group mt-3">
        <label>Permisos</label>
        <div class="d-flex flex-wrap">
            @foreach($permissions as $permission)
                <div class="form-check me-3">
                    <input class="form-check-input" type="checkbox" name="permissions[]" value="{{ $permission->id }}" id="perm_{{ $permission->id }}">
                    <label class="form-check-label" for="perm_{{ $permission->id }}">
                        {{ $permission->name }}
                    </label>
                </div>
            @endforeach
        </div>
    </div>

    <button type="submit" class="btn btn-primary mt-3">Guardar</button>
</form>

        </div>
    </div>
</div>
@endsection
