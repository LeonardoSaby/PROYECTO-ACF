@extends('adminlte::page')

@section('title', 'Editar Permiso')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>Editar Permiso</h1>
        <a href="{{ route('permisos.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Volver
        </a>
    </div>
@stop

@section('content')
<div class="card shadow">
    <div class="card-body">
        <form action="{{ route('permisos.update', $permiso->id) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- NOMBRE DEL PERMISO --}}
            <div class="form-group mb-3">
                <label for="name" class="fw-bold">Nombre del Permiso</label>
                <input type="text" name="name" value="{{ $permiso->name }}" class="form-control" required>
            </div>

            {{-- ASIGNAR PERMISO A ROLES --}}
            <h5 class="mt-4 mb-3 fw-bold text-primary">
                Asignar este Permiso a Roles
            </h5>
            <hr>

            <div class="row">
                @foreach($roles as $rol)
                    <div class="col-md-4 mb-2">
                        <div class="border rounded p-2">
                            <div class="form-check">
                                <input type="checkbox"
                                       name="roles[]"
                                       value="{{ $rol->id }}"
                                       id="rol_{{ $rol->id }}"
                                       class="form-check-input"
                                       {{ in_array($rol->id, $rolesAsignados) ? 'checked' : '' }}>
                                <label class="form-check-label fw-semibold" for="rol_{{ $rol->id }}">
                                    <i class="fas fa-user-shield text-secondary"></i> {{ ucfirst($rol->name) }}
                                </label>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- BOTONES --}}
            <div class="mt-4">
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-save"></i> Guardar Cambios
                </button>
                <a href="{{ route('permisos.index') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-times"></i> Cancelar
                </a>
            </div>
        </form>
    </div>
</div>
@stop