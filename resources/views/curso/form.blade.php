<div class="row padding-1 p-1">
    <div class="col-md-12">
        
        {{-- Nombre del Curso --}}
        <div class="form-group mb-2 mb20">
            <label for="nombre_curso" class="form-label">{{ __('Nombre del Curso') }}</label>
            <input type="text" name="nombre_curso" id="nombre_curso" 
                    class="form-control @error('nombre_curso') is-invalid @enderror"
                    value="{{ old('nombre_curso', $curso?->nombre_curso) }}" >
            {!! $errors->first('nombre_curso', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
    
        {{-- Nivel (Desplegable) --}}
        <div class="form-group mb-2 mb20">
            <label for="nivel_id" class="form-label">{{ __('Nivel') }}</label>
            <select name="nivel_id" id="nivel_id" 
                    class="form-control @error('nivel_id') is-invalid @enderror">
                
                {{-- Esta opción se seleccionará por defecto si no hay un valor previo --}}
                <option value="">-- Selecciona un Nivel --</option> 
                
                @foreach($niveles as $nivel)
                    <option value="{{ $nivel->nivel_id }}" 
                        {{ old('nivel_id', $curso?->nivel_id) == $nivel->nivel_id ? 'selected' : '' }}>
                        {{ $nivel->nombre_nivel }}
                    </option>
                @endforeach
            </select>
            {!! $errors->first('nivel_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

        {{-- Sala (Desplegable) --}}
        <div class="form-group mb-2 mb20">
            <label for="sala_id" class="form-label">{{ __('Sala') }}</label>
            <select name="sala_id" id="sala_id" 
                    class="form-control @error('sala_id') is-invalid @enderror">
                    
                {{-- Esta opción se seleccionará por defecto si no hay un valor previo --}}
                <option value="">-- Selecciona una Sala --</option>
                
                @foreach($salas as $sala)
                    <option value="{{ $sala->sala_id }}" 
                        {{ old('sala_id', $curso?->sala_id) == $sala->sala_id ? 'selected' : '' }}>
                        {{ $sala->nombre_sala }}
                    </option>
                @endforeach
            </select>
            {!! $errors->first('sala_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        
    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('Guardar') }}</button>
    </div>
</div>