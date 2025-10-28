@if(count($infantes) > 0)
    <div class="table-responsive">
        {{-- Aquí se usa un array de detalles con el ID de la inscripción como clave para guardar --}}
        <table class="table table-bordered table-striped" id="infantes-tabla">
            <thead class="thead-light">
                <tr>
                    <th>Infante</th>
                    <th style="width: 20%;">Asistencia</th>
                    <th style="width: 30%;">Observaciones Adicionales</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($infantes as $infante)
                    {{-- Usamos el ID de la inscripción para vincular al infante con el Curso/Turno --}}
                    <tr>
                        <td>
                            {{ $infante->infante->nombre_infante }}
                            {{-- Campo oculto para asegurar que enviamos el ID de la inscripción --}}
                            <input type="hidden" name="detalles[{{ $infante->id_inscripcion }}][id_inscripcion]" value="{{ $infante->id_inscripcion }}">
                        </td>
                        <td>
                            {{-- Campo 'observaciones' en la BD guarda: presente, ausente, justificado --}}
                            <select name="detalles[{{ $infante->id_inscripcion }}][observaciones]" class="form-control" required>
                                <option value="presente" selected>Presente</option>
                                <option value="ausente">Ausente</option>
                                <option value="justificado">Justificado</option>
                            </select>
                        </td>
                        <td>
                            {{-- Campo para observaciones_adicionales --}}
                            <input type="text" 
                                   name="detalles[{{ $infante->id_inscripcion }}][observaciones_adicionales]" 
                                   class="form-control" 
                                   placeholder="Detalles sobre la falta/justificación">
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Botón de Guardar que estará DESPUÉS de la tabla y dentro del formulario principal --}}
    <div class="card-footer text-right">
        <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Guardar Asistencia</button>
    </div>
@else
    <div class="alert alert-warning">
        No hay infantes inscritos para el Curso y Turno seleccionados.
    </div>
@endif
