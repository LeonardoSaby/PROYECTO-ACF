<div class="row p-2">
    <div class="col-md-12">

        {{-- NOMBRE --}}
        <div class="form-group mb-3">
            <label for="nombre_tutor" class="form-label">Nombre</label>
            <input type="text" name="nombre_tutor" id="nombre_tutor" class="form-control @error('nombre_tutor') is-invalid @enderror" 
                   value="{{ old('nombre_tutor', $tutore?->nombre_tutor) }}" placeholder="Nombre completo del tutor">
            {!! $errors->first('nombre_tutor', '<div class="invalid-feedback"><strong>:message</strong></div>') !!}
        </div>

        {{-- APELLIDO --}}
        <div class="form-group mb-3">
            <label for="apellido_tutor" class="form-label">Apellido</label>
            <input type="text" name="apellido_tutor" id="apellido_tutor" class="form-control @error('apellido_tutor') is-invalid @enderror" 
                   value="{{ old('apellido_tutor', $tutore?->apellido_tutor) }}" placeholder="Apellido completo del tutor">
            {!! $errors->first('apellido_tutor', '<div class="invalid-feedback"><strong>:message</strong></div>') !!}
        </div>

        {{-- CARNET DE IDENTIDAD --}}
        <div class="form-group mb-3">
            <label for="CI_tutor" class="form-label">Nro de Carnet</label>
            <input type="text" name="CI_tutor" id="CI_tutor" class="form-control @error('CI_tutor') is-invalid @enderror" 
                   value="{{ old('CI_tutor', $tutore?->CI_tutor) }}" placeholder="Nro de Carnet de identidad del tutor">
            {!! $errors->first('CI_tutor', '<div class="invalid-feedback"><strong>:message</strong></div>') !!}
        </div>

        {{-- TELÉFONO --}}
        <div class="form-group mb-3">
            <label for="telefono_tutor" class="form-label">Teléfono</label>
            <input type="text" name="telefono_tutor" id="telefono_tutor" class="form-control @error('telefono_tutor') is-invalid @enderror" 
                   value="{{ old('telefono_tutor', $tutore?->telefono_tutor) }}" placeholder="Teléfono del tutor">
            {!! $errors->first('telefono_tutor', '<div class="invalid-feedback"><strong>:message</strong></div>') !!}
        </div>

        {{-- DIRECCIÓN --}}
        <div class="form-group mb-4">
            <label for="direccion_tutor" class="form-label">Dirección</label>
            <input type="text" name="direccion_tutor" id="direccion_tutor" class="form-control @error('direccion_tutor') is-invalid @enderror" 
                   value="{{ old('direccion_tutor', $tutore?->direccion_tutor) }}" placeholder="Dirección de domicilio del tutor">
            {!! $errors->first('direccion_tutor', '<div class="invalid-feedback"><strong>:message</strong></div>') !!}
        </div>

        {{-- CORREO --}}
        <div class="form-group mb-3">
            <label for="correo_electronico_tutor" class="form-label">Correo Electrónico</label>
            <input type="email" name="correo_electronico_tutor" id="correo_electronico_tutor" class="form-control @error('correo_electronico_tutor') is-invalid @enderror" 
                   value="{{ old('correo_electronico_tutor', $tutore?->correo_electronico_tutor) }}" placeholder="Correo Electrónico del tutor">
            {!! $errors->first('correo_electronico_tutor', '<div class="invalid-feedback"><strong>:message</strong></div>') !!}
        </div>
        
        {{-- CONTRASEÑA --}}
        <div class="form-group mb-3">
            <label for="password" class="form-label">Contraseña</label>
            <input type="password" name="password" id="password" 
                class="form-control @error('password') is-invalid @enderror" 
                placeholder="Ingrese una contraseña segura">
            {!! $errors->first('password', '<div class="invalid-feedback"><strong>:message</strong></div>') !!}
        </div>

        {{-- CONFIRMAR CONTRASEÑA --}}
        <div class="form-group mb-4">
            <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
            <input type="password" name="password_confirmation" id="password_confirmation" 
                class="form-control @error('password_confirmation') is-invalid @enderror" 
                placeholder="Repita la contraseña">
            {!! $errors->first('password_confirmation', '<div class="invalid-feedback"><strong>:message</strong></div>') !!}
        </div>

        

        {{-- BOTÓN GUARDAR --}}
        <div class="form-group">
            <button type="submit" class="btn btn-primary w-100">Guardar</button>
        </div>

    </div>
</div>
