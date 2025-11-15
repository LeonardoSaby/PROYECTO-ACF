<div class="row padding-1 p-1">
    <div class="col-md-12">

        {{-- Nombre --}}
        <div class="form-group mb-2 mb20">
            <label for="nombre_infante" class="form-label">Nombre</label>
            <input type="text" name="nombre_infante" class="form-control @error('nombre_infante') is-invalid @enderror"
                value="{{ old('nombre_infante', $infante?->nombre_infante) }}"
                id="nombre_infante" placeholder="Nombre completo del infante">
            {!! $errors->first('nombre_infante', '<div class="invalid-feedback"><strong>:message</strong></div>') !!}
        </div>

        {{-- Apellido --}}
        <div class="form-group mb-2 mb20">
            <label for="apellido_infante" class="form-label">Apellido</label>
            <input type="text" name="apellido_infante" class="form-control @error('apellido_infante') is-invalid @enderror"
                value="{{ old('apellido_infante', $infante?->apellido_infante) }}"
                id="apellido_infante" placeholder="Apellido completo del infante">
            {!! $errors->first('apellido_infante', '<div class="invalid-feedback"><strong>:message</strong></div>') !!}
        </div>

        {{-- CI --}}
        <div class="form-group mb-2 mb20">
            <label for="c_i_infante" class="form-label">CI</label>
            <input type="text" name="CI_infante" class="form-control @error('CI_infante') is-invalid @enderror"
                value="{{ old('CI_infante', $infante?->CI_infante) }}"
                id="c_i_infante" placeholder="Carnet del infante">
            {!! $errors->first('CI_infante', '<div class="invalid-feedback"><strong>:message</strong></div>') !!}
        </div>

        {{-- Fecha nacimiento --}}
        <div class="form-group mb-2 mb20">
            <label for="fecha_nacimiento_infante" class="form-label">Fecha Nacimiento</label>
            <input type="date" name="fecha_nacimiento_infante"
                class="form-control @error('fecha_nacimiento_infante') is-invalid @enderror"
                value="{{ old('fecha_nacimiento_infante', $infante?->fecha_nacimiento_infante) }}"
                id="fecha_nacimiento_infante">
            {!! $errors->first('fecha_nacimiento_infante', '<div class="invalid-feedback"><strong>:message</strong></div>') !!}
        </div>

        {{-- Género --}}
        <div class="form-group mb-2 mb20">
            <label for="genero_infante" class="form-label">Género</label>
            @php $generos = ['Masculino','Femenino']; @endphp
            <select name="genero_infante" id="genero_infante"
                class="form-control @error('genero_infante') is-invalid @enderror">
                <option value="">-- Seleccione el Género --</option>
                @foreach ($generos as $g)
                    <option value="{{ $g }}" {{ old('genero_infante', $infante?->genero_infante) == $g ? 'selected' : '' }}>
                        {{ $g }}
                    </option>
                @endforeach
            </select>
            {!! $errors->first('genero_infante', '<div class="invalid-feedback"><strong>:message</strong></div>') !!}
        </div>

        <hr class="my-3">
        <h5 class="mb-3"><strong>Asignar Tutores</strong></h5>

        <div id="contenedor-tutores">

            @php $tutores_asignados = $infante?->tutores ?? []; @endphp

            @forelse($tutores_asignados as $t)
                <div class="tutor-item border rounded p-3 mb-3 bg-light">

                    <div class="d-flex gap-2">
                        <select name="tutores[]" class="form-control">
                            <option value="">-- Seleccione un tutor --</option>
                            @foreach($tutores as $tutor)
                                <option value="{{ $tutor->tutor_id }}"
                                    {{ $tutor->tutor_id == $t->pivot->tutor_id ? 'selected' : '' }}>
                                    {{ $tutor->nombre_tutor }} {{ $tutor->apellido_tutor }}
                                </option>
                            @endforeach
                        </select>

                        {{-- Botón eliminar compacto --}}
                        <button type="button" class="btn btn-danger btn-eliminar-tutor">X</button>
                    </div>

                    <div class="form-group mt-2">
                        <label>Parentesco</label>
                        <select name="parentezcos[]" class="form-control">
                            <option value="">-- Seleccione el parentesco --</option>
                            <option value="Padre" {{ $t->pivot->parentesco=='Padre'? 'selected':'' }}>Padre</option>
                            <option value="Madre" {{ $t->pivot->parentesco=='Madre'? 'selected':'' }}>Madre</option>
                            <option value="Tutor Legal" {{ $t->pivot->parentesco=='Tutor Legal'? 'selected':'' }}>Tutor Legal</option>
                        </select>
                    </div>

                </div>
            @empty
                {{-- Campo vacío por defecto --}}
                <div class="tutor-item border rounded p-3 mb-3 bg-light">

                    <div class="d-flex gap-2">
                        <select name="tutores[]" class="form-control">
                            <option value="">-- Seleccione un tutor --</option>
                            @foreach($tutores as $tutor)
                                <option value="{{ $tutor->tutor_id }}">{{ $tutor->nombre_tutor }} {{ $tutor->apellido_tutor }}</option>
                            @endforeach
                        </select>

                        <button type="button" class="btn btn-danger btn-eliminar-tutor">X</button>
                    </div>

                    <div class="form-group mt-2">
                        <label>Parentesco</label>
                        <select name="parentezcos[]" class="form-control">
                            <option value="">-- Seleccione el parentesco --</option>
                            <option value="Padre">Padre</option>
                            <option value="Madre">Madre</option>
                            <option value="Tutor Legal">Tutor Legal</option>
                        </select>
                    </div>

                </div>
            @endforelse

        </div>

        {{-- Botón agregar tutor --}}
        <button type="button" id="btn-agregar-tutor" class="btn btn-success mt-2">+ Añadir otro tutor</button>

        {{-- Botón GUARDAR --}}
        <div class="mt-4">
            <button type="submit" class="btn btn-primary w-100">Guardar</button>
        </div>

    </div>
</div>


<script>
    // Agregar tutor
    document.getElementById('btn-agregar-tutor').addEventListener('click', function () {
        let cont = document.getElementById('contenedor-tutores');
        let original = cont.querySelector('.tutor-item');
        let clon = original.cloneNode(true);

        clon.querySelectorAll('input').forEach(i => i.value = '');
        clon.querySelectorAll('select').forEach(s => s.selectedIndex = 0);

        cont.appendChild(clon);
    });

    // Eliminar tutor
    document.addEventListener('click', function (e) {
        if (e.target.classList.contains('btn-eliminar-tutor')) {
            let items = document.querySelectorAll('.tutor-item');
            if (items.length > 1) {
                e.target.closest('.tutor-item').remove();
            } else {
                alert("Debe haber al menos un tutor.");
            }
        }
    });
</script>
