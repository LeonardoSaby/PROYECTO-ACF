@extends('adminlte::page')

@section('title', 'Editar Asistencia')

@section('content_header')
    <h1>Editar Asistencia</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-warning">
                    <div class="card-header bg-warning">
                        <h3 class="card-title"><i class="fas fa-edit"></i> Editar Asistencia Existente</h3>
                    </div>
                    <div class="card-body">

                        {{-- Formulario de Edición que usa el método PUT para actualizar --}}
                        <form id="form-asistencia-edit" method="POST" action="{{ route('asistencias.update', $asistencia->id_asistencia) }}">
                            @csrf
                            @method('PUT')
                            
                            {{-- Contenedor de Información (No editable, solo referencia) --}}
                            <div class="row mb-4 p-3 border rounded bg-light">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="fecha">Fecha de Asistencia:</label>
                                        <input type="date" class="form-control" id="fecha" name="fecha" value="{{ \Carbon\Carbon::parse($asistencia->fecha)->format('Y-m-d') }}" readonly>
                                        {{-- Campo oculto para enviar la fecha al update --}}
                                        <input type="hidden" name="fecha" value="{{ \Carbon\Carbon::parse($asistencia->fecha)->format('Y-m-d') }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Curso:</label>
                                        {{-- $referencia viene del controlador y es el primer detalle para obtener el Curso/Turno --}}
                                        <p class="form-control-static font-weight-bold">{{ $referencia->inscripcion->curso->nombre_curso ?? 'N/A' }}</p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Turno:</label>
                                        <p class="form-control-static font-weight-bold">{{ $referencia->inscripcion->turno->nombre_turno ?? 'N/A' }}</p>
                                    </div>
                                </div>
                            </div>

                            {{-- Tabla de Detalles (Prellenada para Edición) --}}
                            <div class="row mt-4">
                                <div class="col-12">
                                    <h4 class="mb-3"><i class="fas fa-users"></i> Lista de Infantes</h4>
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>ID Detalle</th>
                                                    <th>Infante</th>
                                                    <th style="width: 25%;">Estado Asistencia</th>
                                                    <th style="width: 35%;">Observaciones Adicionales</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($asistencia->detalleAsistencias as $detalle)
                                                    <tr>
                                                        <td>{{ $detalle->id_detalle_asistencia }}</td>
                                                        <td>
                                                            {{ $detalle->inscripcion->infante->nombre_infante }}
                                                            {{-- Campo oculto para asegurar que enviamos el ID de detalle --}}
                                                            <input type="hidden" name="detalles[{{ $detalle->id_detalle_asistencia }}][id_detalle]" value="{{ $detalle->id_detalle_asistencia }}">
                                                        </td>
                                                        <td>
                                                            <select name="detalles[{{ $detalle->id_detalle_asistencia }}][observaciones]" class="form-control" required>
                                                                <option value="presente" {{ $detalle->observaciones == 'presente' ? 'selected' : '' }}>Presente</option>
                                                                <option value="ausente" {{ $detalle->observaciones == 'ausente' ? 'selected' : '' }}>Ausente</option>
                                                                <option value="justificado" {{ $detalle->observaciones == 'justificado' ? 'selected' : '' }}>Justificado</option>
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <input type="text" 
                                                                   name="detalles[{{ $detalle->id_detalle_asistencia }}][observaciones_adicionales]" 
                                                                   class="form-control" 
                                                                   placeholder="Detalles sobre el estado" 
                                                                   value="{{ $detalle->observaciones_adicionales }}">
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="4" class="text-center">No se encontraron infantes en esta asistencia.</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="card-footer mt-4">
                                <button type="submit" class="btn btn-warning"><i class="fas fa-save"></i> Guardar Cambios</button>
                                <a href="{{ route('asistencias.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left"></i> Cancelar
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
