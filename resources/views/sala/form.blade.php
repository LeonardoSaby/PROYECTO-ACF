<div class="row padding-1 p-1">
    <div class="col-md-12">
        
        <div class="form-group mb-2 mb20">
            <label for="nombre_sala" class="form-label">{{ __('Nombre') }}</label>
            <input type="text" name="nombre_sala" class="form-control @error('nombre_sala') is-invalid @enderror" value="{{ old('nombre_sala', $sala?->nombre_sala) }}" id="nombre_sala" placeholder="Nombre de la sala">
            {!! $errors->first('nombre_sala', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="capacidad_maxima" class="form-label">{{ __('Capacidad Maxima') }}</label>
            <input type="text" name="capacidad_maxima" class="form-control @error('capacidad_maxima') is-invalid @enderror" value="{{ old('capacidad_maxima', $sala?->capacidad_maxima) }}" id="capacidad_maxima" placeholder="Capacidad Maxima de la sala">
            {!! $errors->first('capacidad_maxima', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('Guardar') }}</button>
    </div>
</div>