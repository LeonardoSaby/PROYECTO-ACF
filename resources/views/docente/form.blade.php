<div class="row padding-1 p-1">
    <div class="col-md-12">
        
        <div class="form-group mb-2 mb20">
            <label for="nombre_docente" class="form-label">{{ __('Nombre') }}</label>
            <input type="text" name="nombre_docente" class="form-control @error('nombre_docente') is-invalid @enderror" value="{{ old('nombre_docente', $docente?->nombre_docente) }}" id="nombre_docente" placeholder="Nombre completo del docente">
            {!! $errors->first('nombre_docente', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="apellido_docente" class="form-label">{{ __('Apellido Docente') }}</label>
            <input type="text" name="apellido_docente" class="form-control @error('apellido_docente') is-invalid @enderror" value="{{ old('apellido_docente', $docente?->apellido_docente) }}" id="apellido_docente" placeholder="Apellido completo del docente">
            {!! $errors->first('apellido_docente', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="telefono_docente" class="form-label">{{ __('Telefono Docente') }}</label>
            <input type="text" name="telefono_docente" class="form-control @error('telefono_docente') is-invalid @enderror" value="{{ old('telefono_docente', $docente?->telefono_docente) }}" id="telefono_docente" placeholder="Telefono del Docente">
            {!! $errors->first('telefono_docente', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="c_i_docente" class="form-label">{{ __('Ci Docente') }}</label>
            <input type="text" name="CI_docente" class="form-control @error('CI_docente') is-invalid @enderror" value="{{ old('CI_docente', $docente?->CI_docente) }}" id="c_i_docente" placeholder="CI del Docente">
            {!! $errors->first('CI_docente', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="correo_electronico_docente" class="form-label">{{ __('Correo Electronico Docente') }}</label>
            <input type="text" name="correo_electronico_docente" class="form-control @error('correo_electronico_docente') is-invalid @enderror" value="{{ old('correo_electronico_docente', $docente?->correo_electronico_docente) }}" id="correo_electronico_docente" placeholder="Correo Electronico del docente">
            {!! $errors->first('correo_electronico_docente', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="estado" class="form-label">{{ __('Estado') }}</label>
            <input type="text" name="estado" class="form-control @error('estado') is-invalid @enderror" value="{{ old('estado', $docente?->estado) }}" id="estado" placeholder="Estado">
            {!! $errors->first('estado', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('Guardar') }}</button>
    </div>
</div>