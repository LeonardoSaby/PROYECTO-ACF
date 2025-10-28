@extends('adminlte::page')

@section('template_title')
    Tomar Asistencia
@endsection

@section('content_header')
    <h1>Tomar Asistencia Diaria</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-header bg-primary">
                        <h3 class="card-title"><i class="fas fa-calendar-check"></i> Selección de Filtros</h3>
                    </div>
                    <div class="card-body">

                        {{-- Formulario principal que enviará los filtros y los detalles de asistencia al store --}}
                        <form id="form-asistencia" method="POST" action="{{ route('asistencias.store') }}">
                            @csrf
                            
                            {{-- Contenedor de Filtros --}}
                            <div class="row mb-4 p-3 border rounded bg-light">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="fecha">Fecha de Asistencia:</label>
                                        {{-- El valor por defecto es la fecha de hoy --}}
                                        <input type="date" class="form-control" id="fecha" name="fecha" required value="{{ date('Y-m-d') }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="curso_id">Curso:</label>
                                        {{-- La variable $cursos viene del controlador AsistenciaController@create --}}
                                        <select id="curso_id" name="curso_id" class="form-control" required>
                                            <option value="" selected disabled>-- Seleccionar Curso --</option>
                                            @foreach ($cursos as $curso)
                                                <option value="{{ $curso->id}}">{{ $curso->nombre_curso }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="turno_id">Turno:</label>
                                        {{-- La variable $turnos viene del controlador AsistenciaController@create --}}
                                        <select id="turno_id" name="turno_id" class="form-control" required>
                                            <option value="" selected disabled>-- Seleccionar Turno --</option>
                                            @foreach ($turnos as $turno)
                                                <option value="{{ $turno->id_turno }}">{{ $turno->nombre_turno }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 text-center">
                                    <button type="button" id="btn-generar-lista" class="btn btn-info mt-2">
                                        <i class="fas fa-list-alt"></i> Generar Lista de Infantes
                                    </button>
                                </div>
                            </div>

                            {{-- Contenedor donde se inyecta la tabla de infantes (tabla_detalles.blade.php) --}}
                            <div id="lista-asistencia-container">
                                <div class="alert alert-info text-center">
                                    Seleccione los filtros para cargar la lista de infantes.
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

{{-- CAMBIADO: Usamos @push('js') en lugar de @section('js') para asegurar que el script se cargue DESPUÉS de jQuery --}}
@push('js')
<script>
    $(document).ready(function() {
        // La URL de la ruta AJAX, ya corregida.
        const urlGenerarLista = "{{ route('asistencias.lista') }}"; 
        const container = $('#lista-asistencia-container');
        
        // Función para mostrar mensajes de error/éxito
        function showMessage(message, type = 'info') {
            container.html(`<div class="alert alert-${type}">${message}</div>`);
        }
        
        // Manejador del botón para generar la lista
        $('#btn-generar-lista').on('click', function(e) {
            e.preventDefault();

            // Obtenemos los valores de los selectores
            const fecha = $('#fecha').val();
            const curso_id = $('#curso_id').val();
            const id_turno = $('#turno_id').val(); 

            // 1. Validación de campos
            // Se comprueba si alguno de los valores es nulo, indefinido, o cadena vacía ("").
            if (!fecha || !curso_id || !id_turno) {
                showMessage('Error de Selección: Por favor, seleccione Fecha, Curso y Turno antes de continuar.', 'danger');
                return;
            }

            // Deshabilitar botón y mostrar spinner
            const btn = $(this);
            btn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Cargando...');

            // 2. Llamada AJAX al controlador
            $.ajax({
                url: urlGenerarLista,
                method: 'POST',
                data: {
                    _token: $('input[name="_token"]').val(), // Token CSRF
                    fecha: fecha,
                    curso_id: curso_id, // Clave esperada por el controlador
                    id_turno: id_turno  // Clave esperada por el controlador (corregida)
                },
                success: function(response) {
                    if(response.error) {
                        // Usamos response.message para los mensajes del controlador
                        showMessage(response.message, 'warning'); 
                    } else {
                        // Si todo es exitoso, inyecta el HTML de la tabla
                        container.html(response.html); 
                    }
                },
                error: function(xhr) {
                    // Manejar errores de servidor o validación
                    let errorMessage = 'Error al cargar la lista. Intente de nuevo más tarde.';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                         // Si Laravel devuelve un error JSON con mensaje (ej: validación 422)
                        errorMessage = xhr.responseJSON.message;
                    } else if (xhr.status === 409) {
                        // Error de conflicto (ya existe asistencia)
                        errorMessage = JSON.parse(xhr.responseText).message;
                    }
                    showMessage(errorMessage, 'danger');
                },
                complete: function() {
                    // Habilitar botón al finalizar
                    btn.prop('disabled', false).html('<i class="fas fa-list-alt"></i> Generar Lista de Infantes');
                }
            });
        });
    });
</script>
@endpush
