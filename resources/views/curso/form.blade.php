<div class="row padding-1 p-1">
    <div class="col-md-12">
        
    

        {{-- Nivel --}}
        <div class="form-group mb-2 mb20">
            <label for="nivel_id" class="form-label">{{ __('Nivel') }}</label>
            <select name="nivel_id" id="nivel_id" 
                    class="form-control @error('nivel_id') is-invalid @enderror">
                <option value="">-- Selecciona un Nivel --</option>
                @foreach($niveles as $nivel)
                    <option value="{{ $nivel->id }}" 
                        {{ old('nivel_id', $curso?->nivel_id) == $nivel->id ? 'selected' : '' }}>
                        {{ $nivel->nombre_nivel }}
                    </option>
                @endforeach
            </select>
            {!! $errors->first('nivel_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

        {{-- Sala --}}
        <div class="form-group mb-2 mb20">
            <label for="sala_id" class="form-label">{{ __('Sala') }}</label>
            <select name="sala_id" id="sala_id" 
                    class="form-control @error('sala_id') is-invalid @enderror">
                <option value="">-- Selecciona una Sala --</option>
                @foreach($salas as $sala)
                    <option value="{{ $sala->id }}" 
                        {{ old('sala_id', $curso?->sala_id) == $sala->id ? 'selected' : '' }}>
                        {{ $sala->nombre_sala }}
                    </option>
                @endforeach
            </select>
            {!! $errors->first('sala_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

        {{-- Docente --}}
        {{-- Docente --}}
<div class="form-group mb-2 mb20">
    <label for="docente_id" class="form-label">{{ __('Docente') }}</label>
    <select name="docente_id" id="docente_id" 
            class="form-control @error('docente_id') is-invalid @enderror">
        <option value="">-- Selecciona un Docente --</option>
        @foreach($docentes as $docente)
            <option value="{{ $docente->id }}" 
                {{ old('docente_id', $curso?->docente_id) == $docente->id ? 'selected' : '' }}>
                {{ $docente->nombre_docente }}
            </option>
        @endforeach
    </select>
    {!! $errors->first('docente_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
</div>

        {{-- Estado --}}
        <div class="form-group mb-2 mb20">
            <label for="estado" class="form-label">{{ __('Estado') }}</label>
            <select name="estado" id="estado" 
                    class="form-control @error('estado') is-invalid @enderror">
                <option value="Activo" {{ old('estado', $curso?->estado) == 'Activo' ? 'selected' : '' }}>Activo</option>
                <option value="Inactivo" {{ old('estado', $curso?->estado) == 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
            </select>
            {!! $errors->first('estado', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>
