<div class="row padding-1 p-1">
    <div class="col-md-12">
        
        <div class="form-group mb-2 mb20">
            <label for="infante_id" class="form-label">{{ __('Infante') }}</label>
            <select name="infante_id" id="infante_id" class="form-control @error('infante_id') is-invalid @enderror">
                <option value="">Seleccione un infante</option>
                @foreach($infantes as $infante)
                    <option value="{{ $infante->id }}" {{ old('infante_id', $infantesTutore?->infante_id) == $infante->id ? 'selected' : '' }}>
                        {{ $infante->nombre_infante .' '. $infante->apellido_infante }}
                    </option>
                @endforeach
            </select>
            {!! $errors->first('infante_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="tutor_id" class="form-label">{{ __('Tutor') }}</label>
            <select name="tutor_id" id="tutor_id" class="form-control @error('tutor_id') is-invalid @enderror">
                <option value="">Seleccione un tutor</option>
                @foreach($tutores as $tutor)
                    <option value="{{ $tutor->id }}" {{ old('tutor_id', $infantesTutore?->tutor_id) == $tutor->id ? 'selected' : '' }}>
                        {{ $tutor->nombre_tutor .' '. $tutor->apellido_tutor }}
                    </option>
                @endforeach
            </select>
            {!! $errors->first('tutor_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="parentesco" class="form-label">{{ __('Parentesco') }}</label>
            <select name="parentesco" id="parentesco" class="form-control @error('parentesco') is-invalid @enderror">
                <option value="">Seleccione el parentesco</option>
                <option value="Madre" {{ old('parentesco', $infantesTutore?->parentesco) == 'Madre' ? 'selected' : '' }}>Madre</option>
                <option value="Padre" {{ old('parentesco', $infantesTutore?->parentesco) == 'Padre' ? 'selected' : '' }}>Padre</option>
                <option value="Tío(a)" {{ old('parentesco', $infantesTutore?->parentesco) == 'Tío(a)' ? 'selected' : '' }}>Tío(a)</option>
                <option value="Abuelo(a)" {{ old('parentesco', $infantesTutore?->parentesco) == 'Abuelo(a)' ? 'selected' : '' }}>Abuelo(a)</option>
                <option value="Otro" {{ old('parentesco', $infantesTutore?->parentesco) == 'Otro' ? 'selected' : '' }}>Otro</option>
            </select>
            {!! $errors->first('parentesco', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="estado" class="form-label">{{ __('Estado') }}</label>
            <select name="estado" id="estado" class="form-control @error('estado') is-invalid @enderror">
                <option value="">Seleccione el estado</option>
                <option value="Activo" {{ old('estado', $infantesTutore?->estado) == 'Activo' ? 'selected' : '' }}>Activo</option>
                <option value="Inactivo" {{ old('estado', $infantesTutore?->estado) == 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
            </select>
            {!! $errors->first('estado', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('#infante_id').select2({
            width: '100%',
            placeholder: 'Seleccione un infante'
        });
        $('#tutor_id').select2({
            width: '100%',
            placeholder: 'Seleccione un tutor'
        });
        $('#parentesco').select2({
            width: '100%',
            placeholder: 'Seleccione el parentesco'
        });
        $('#estado').select2({
            width: '100%',
            placeholder: 'Seleccione el estado'
        });
    });
</script>