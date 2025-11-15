@extends('adminlte::page')

@section('title', 'Nuevo Permiso')

@section('content_header')
    <h1>Registrar Nuevo Permiso</h1>
@stop

@section('content')
<div class="card shadow">
    <div class="card-body">
        <form action="{{ route('permisos.store') }}" method="POST">
            @csrf

            <div class="form-group mb-3">
                <label for="name">Nombre del Permiso</label>
                <input type="text" name="name" class="form-control" required placeholder="Ejemplo: ver reportes, eliminar citas...">
            </div>

            <button type="submit" class="btn btn-success">
                <i class="fas fa-save"></i> Guardar
            </button>
            <a href="{{ route('permisos.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</div>
@stop