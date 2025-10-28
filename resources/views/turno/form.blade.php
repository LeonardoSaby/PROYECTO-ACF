<div class="row padding-1 p-1">
    <div class="col-md-12">
        
        <div class="form-group mb-2 mb20">
            <label for="nombre_turno" class="form-label">{{ __('Nombre') }}</label>
            <input type="text" name="nombre_turno" class="form-control @error('nombre_turno') is-invalid @enderror" value="{{ old('nombre_turno', $turno?->nombre_turno) }}" id="nombre_turno" placeholder="Nombre del Turno">
            {!! $errors->first('nombre_turno', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="hora_inicio" class="form-label">{{ __('Hora Inicio') }}</label>
            <input type="time" name="hora_inicio" class="form-control @error('hora_inicio') is-invalid @enderror" value="{{ old('hora_inicio', $turno?->hora_inicio) }}" id="hora_inicio" placeholder="Hora de entrada">
            {!! $errors->first('hora_inicio', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="hora_fin" class="form-label">{{ __('Hora Fin') }}</label>
            <input type="time" name="hora_fin" class="form-control @error('hora_fin') is-invalid @enderror" value="{{ old('hora_fin', $turno?->hora_fin) }}" id="hora_fin" placeholder="Hora de salida">
            {!! $errors->first('hora_fin', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="estado" class="form-label">{{ __('Estado') }}</label>
            <input type="text" name="estado" class="form-control @error('estado') is-invalid @enderror" value="{{ old('estado', $turno?->estado) }}" id="estado" placeholder="Estado">
            {!! $errors->first('estado', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('Guardar') }}</button>
    </div>
</div>