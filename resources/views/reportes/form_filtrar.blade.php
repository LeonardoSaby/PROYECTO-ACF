@extends('adminlte::page')

@section('title', 'Filtrar Inscritos')

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Filtrar Inscritos por Curso y Turno</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('reportes.lista_filtrada_pdf') }}" method="GET" target="_blank" class="row g-3 align-items-end">
                <div class="col-md-5">
                    <label class="form-label">Curso:</label>
                    <select name="curso_id" class="form-control" required>
                        <option value="">Seleccione</option>
                        @foreach($cursos as $curso)
                            <option value="{{ $curso->curso_id }}">{{ $curso->nombre_curso }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-5">
                    <label class="form-label">Turno:</label>
                    <select name="turno_id" class="form-control" required>
                        <option value="">Seleccione</option>
                        @foreach($turnos as $turno)
                            <option value="{{ $turno->turno_id }}">{{ $turno->nombre_turno }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2 d-flex">
                    <button type="submit" class="btn btn-success w-100">
                        <i class="fas fa-file-pdf"></i> Exportar PDF
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
