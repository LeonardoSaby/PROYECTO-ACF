<div class="row padding-1 p-1">
    <div class="col-md-12">
        
        <div class="form-group mb-2 mb20">
            <label for="nombre_infante" class="form-label">{{ __('Nombre') }}</label>
            <input type="text" name="nombre_infante" class="form-control @error('nombre_infante') is-invalid @enderror" value="{{ old('nombre_infante', $infante?->nombre_infante) }}" id="nombre_infante" placeholder="Nombre completo del infante">
            {!! $errors->first('nombre_infante', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="apellido_infante" class="form-label">{{ __('Apellido') }}</label>
            <input type="text" name="apellido_infante" class="form-control @error('apellido_infante') is-invalid @enderror" value="{{ old('apellido_infante', $infante?->apellido_infante) }}" id="apellido_infante" placeholder="Apellido completo del infante">
            {!! $errors->first('apellido_infante', '<div class="invalid-feedback" role="alert"><strong>:messages</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="c_i_infante" class="form-label">{{ __('CI') }}</label>
            <input type="text" name="CI_infante" class="form-control @error('CI_infante') is-invalid @enderror" value="{{ old('CI_infante', $infante?->CI_infante) }}" id="c_i_infante" placeholder="Nro de carnet de identidad del infante">
            {!! $errors->first('CI_infante', '<div class="invalid-feedback" role="alert"><strong>:messages</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="fecha_nacimiento_infante" class="form-label">{{ __('Fecha Nacimiento') }}</label>
            <input type="date" name="fecha_nacimiento_infante" class="form-control @error('fecha_nacimiento_infante') is-invalid @enderror" value="{{ old('fecha_nacimiento_infante', $infante?->fecha_nacimiento_infante) }}" id="fecha_nacimiento_infante" placeholder="Fecha Nacimiento Infante">
            {!! $errors->first('fecha_nacimiento_infante', '<div class="invalid-feedback" role="alert"><strong>:messages</strong></div>') !!}
        </div>
        
        <div class="form-group mb-2 mb20">
            <label for="genero_infante" class="form-label">{{ __('Genero') }}</label>
            <input type="text" name="genero_infante" class="form-control @error('genero_infante') is-invalid @enderror" value="{{ old('genero_infante', $infante?->genero_infante) }}" id="genero_infante" placeholder="Genero del infante">
            {!! $errors->first('genero_infante', '<div class="invalid-feedback" role="alert"><strong>:messages</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="estado" class="form-label">{{ __('Estado') }}</label>
            <input type="text" name="estado" class="form-control @error('estado') is-invalid @enderror" value="{{ old('estado', $infante?->estado) }}" id="estado" placeholder="Estado">
            {!! $errors->first('estado', '<div class="invalid-feedback" role="alert"><strong>:messages</strong></div>') !!}
        </div>

    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('Guardar') }}</button>
    </div>
</div>