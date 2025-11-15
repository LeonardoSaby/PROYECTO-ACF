@extends('adminlte::page')

@section('title', 'Nuevo Rol')

@section('content_header')
    <h1>Crear Nuevo Rol</h1>
@stop

@section('content')
<div class="card shadow">
    <div class="card-body">
        <form action="{{ route('roles.store') }}" method="POST">
            @csrf

            <div class="form-group mb-3">
                <label for="name">Nombre del Rol</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>

            <h5 class="mt-4 mb-2">Permisos disponibles</h5>
            <hr>

            <div class="row">
                @foreach ($permisos as $grupo => $items)
                    <div class="col-md-4 mb-3">
                        <div class="border rounded p-2">
                            <h6 class="fw-bold text-primary text-uppercase">{{ $grupo }}</h6>
                            @foreach ($items as $permiso)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" 
                                           name="permissions[]" 
                                           value="{{ $permiso->name }}">
                                    <label class="form-check-label">{{ ucfirst($permiso->name) }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>

            <button type="submit" class="btn btn-success mt-3">Guardar</button>
            <a href="{{ route('roles.index') }}" class="btn btn-secondary mt-3">Cancelar</a>
        </form>
    </div>
</div>
@stop