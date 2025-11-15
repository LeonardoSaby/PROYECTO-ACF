{{-- Mensajes generales del controlador --}}
@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif



<div class="row padding-1 p-1">
    <div class="col-md-12">
        
        <div class="form-group mb-2 mb20">
            <label for="infante_id" class="form-label">Infante</label>
            <select name="infante_id" id="infante_id" class="form-control @error('infante_id') is-invalid @enderror">
                <option value="">Seleccione un infante</option>
                @foreach($infantes as $infante)
                    <option value="{{ $infante->infante_id }}" {{ old('infante_id', $inscripcione?->infante_id) == $infante->infante_id ? 'selected' : '' }}>
                        {{ $infante->nombre_infante .' '. $infante->apellido_infante }}
                    </option>
                @endforeach
            </select>
            @error('infante_id')
                <div class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></div>
            @enderror
        </div>
        
        <div class="form-group mb-2 mb20">
            <label for="curso_id" class="form-label">Curso</label>
            <select name="curso_id" id="curso_id" class="form-control @error('curso_id') is-invalid @enderror">
                <option value="">Seleccione un curso</option>
                @foreach($cursos as $curso)
                    <option value="{{ $curso->curso_id }}" {{ old('curso_id', $inscripcione?->curso_id) == $curso->curso_id ? 'selected' : '' }}>
                        {{ $curso->nombre_curso }}
                    </option>
                @endforeach
            </select>
            @error('curso_id')
                <div class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></div>
            @enderror
        </div>

        <div class="form-group mb-2 mb20">
            <label for="turno_id" class="form-label">Turno</label>
            <select name="turno_id" id="turno_id" class="form-control @error('turno_id') is-invalid @enderror">
                <option value="">Seleccione un turno</option>
                @foreach($turnos as $turno)
                    <option value="{{ $turno->turno_id }}" {{ old('turno_id', $inscripcione?->turno_id) == $turno->turno_id ? 'selected' : '' }}>
                        {{ $turno->nombre_turno }}
                    </option>
                @endforeach
            </select>
            @error('turno_id')
                <div class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></div>
            @enderror
        </div>
        
    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">Guardar inscripción</button>
    </div>
</div>
