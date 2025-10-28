<div class="row padding-1 p-1">
    <div class="col-md-12">
        
        <div class="form-group mb-2 mb20">
            <label for="nombre_nivel" class="form-label">{{ __('Nombre Nivel') }}</label>
            <input type="text" name="nombre_nivel" class="form-control @error('nombre_nivel') is-invalid @enderror" value="{{ old('nombre_nivel', $nivele?->nombre_nivel) }}" id="nombre_nivel" placeholder="Nombre Nivel">
            {!! $errors->first('nombre_nivel', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="edad_minima" class="form-label">{{ __('Edad Minima') }}</label>
            <input type="text" name="edad_minima" class="form-control @error('edad_minima') is-invalid @enderror" value="{{ old('edad_minima', $nivele?->edad_minima) }}" id="edad_minima" placeholder="Edad Minima">
            {!! $errors->first('edad_minima', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="edad_maxima" class="form-label">{{ __('Edad Maxima') }}</label>
            <input type="text" name="edad_maxima" class="form-control @error('edad_maxima') is-invalid @enderror" value="{{ old('edad_maxima', $nivele?->edad_maxima) }}" id="edad_maxima" placeholder="Edad Maxima">
            {!! $errors->first('edad_maxima', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="estado" class="form-label">{{ __('Estado') }}</label>
            <input type="text" name="estado" class="form-control @error('estado') is-invalid @enderror" value="{{ old('estado', $nivele?->estado) }}" id="estado" placeholder="Estado">
            {!! $errors->first('estado', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>