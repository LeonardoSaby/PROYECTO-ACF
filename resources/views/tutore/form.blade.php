<div class="row padding-1 p-1">
    <div class="col-md-12">
        
        <div class="form-group mb-2 mb20">
            <label for="nombre_tutor" class="form-label">{{ __('Nombre') }}</label>
            <input type="text" name="nombre_tutor" class="form-control @error('nombre_tutor') is-invalid @enderror" value="{{ old('nombre_tutor', $tutore?->nombre_tutor) }}" id="nombre_tutor" placeholder="Nombre completo del tutor">
            {!! $errors->first('nombre_tutor', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="apellido_tutor" class="form-label">{{ __('Apellido') }}</label>
            <input type="text" name="apellido_tutor" class="form-control @error('apellido_tutor') is-invalid @enderror" value="{{ old('apellido_tutor', $tutore?->apellido_tutor) }}" id="apellido_tutor" placeholder="Apellido completo del tutor">
            {!! $errors->first('apellido_tutor', '<div class="invalid-feedback" role="alert"><strong>:messages</strong></div>') !!}
            {!! $errors->first('apellido_tutor', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="c_i_tutor" class="form-label">{{ __('Nro de Carnet') }}</label>
            <input type="text" name="CI_tutor" class="form-control @error('CI_tutor') is-invalid @enderror" value="{{ old('CI_tutor', $tutore?->CI_tutor) }}" id="c_i_tutor" placeholder="Nro de Carnet de identidad del tutor">
            {!! $errors->first('CI_tutor', '<div class="invalid-feedback" role="alert"><strong>:messages</strong></div>') !!}
            {!! $errors->first('CI_tutor', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="telefono_tutor" class="form-label">{{ __('Telefono') }}</label>
            <input type="text" name="telefono_tutor" class="form-control @error('telefono_tutor') is-invalid @enderror" value="{{ old('telefono_tutor', $tutore?->telefono_tutor) }}" id="telefono_tutor" placeholder="Telefono del tutor">
            {!! $errors->first('telefono_tutor', '<div class="invalid-feedback" role="alert"><strong>:messages</strong></div>') !!}
            {!! $errors->first('telefono_tutor', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="correo_electronico_tutor" class="form-label">{{ __('Correo Electronico') }}</label>
            <input type="text" name="correo_electronico_tutor" class="form-control @error('correo_electronico_tutor') is-invalid @enderror" value="{{ old('correo_electronico_tutor', $tutore?->correo_electronico_tutor) }}" id="correo_electronico_tutor" placeholder="Correo Electronico del tutor">
            {!! $errors->first('correo_electronico_tutor', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="direccion_tutor" class="form-label">{{ __('Direccion') }}</label>
            <input type="text" name="direccion_tutor" class="form-control @error('direccion_tutor') is-invalid @enderror" value="{{ old('direccion_tutor', $tutore?->direccion_tutor) }}" id="direccion_tutor" placeholder="Direccion de domicilio del tutor">
            {!! $errors->first('direccion_tutor', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="estado" class="form-label">{{ __('Estado') }}</label>
            <input type="text" name="estado" class="form-control @error('estado') is-invalid @enderror" value="{{ old('estado', $tutore?->estado) }}" id="estado" placeholder="Estado">
            {!! $errors->first('estado', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('Guardar') }}</button>
    </div>
</div>