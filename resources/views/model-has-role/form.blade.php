@csrf

<div class="card shadow-lg border-0 p-4 rounded-4" style="max-width: 600px; margin:auto; background: #f8f9fc;">
    <h3 class="mb-4 text-center fw-bold">Asignar Roles a Usuarios</h3>

    {{-- Usuarios --}}
    @if(isset($users))
    <div class="mb-3">
        <label class="form-label fw-semibold">Seleccionar Usuarios</label>

        <div class="p-3 rounded-3" style="background:#fff; border:1px solid #ddd;">
            @foreach ($users as $u)
                <div class="form-check mb-2">
                    <input
                        class="form-check-input"
                        type="checkbox"
                        name="users[]"
                        id="user{{ $u->id }}"
                        value="{{ $u->id }}"
                        {{ (collect(old('users'))->contains($u->id)) ? 'checked' : '' }}
                    >

                    <label class="form-check-label" for="user{{ $u->id }}">
                        {{ $u->name }}
                    </label>
                </div>
            @endforeach
        </div>
        {!! $errors->first('users', '<div class="invalid-feedback d-block"><strong>:message</strong></div>') !!}
    </div>
    @elseif(isset($user))
        {{-- Mostrar el usuario fijo en edit --}}
        <input type="hidden" name="user_id" value="{{ $user->id }}">
        <div class="mb-3">
            <label class="form-label fw-semibold">Usuario</label>
            <input type="text" class="form-control" value="{{ $user->name }}" disabled>
        </div>
    @endif

    {{-- Roles --}}
    <div class="mb-3">
        <label class="form-label fw-semibold">Seleccionar Roles</label>

        <div class="p-3 rounded-3" style="background:#fff; border:1px solid #ddd;">
            @foreach ($roles as $role)
                <div class="form-check mb-2">
                    <input
                        class="form-check-input"
                        type="checkbox"
                        name="roles[]"
                        id="role{{ $role->id }}"
                        value="{{ $role->id }}"
                        @if(
                            (isset($user) && $user->roles->contains('id', $role->id)) ||
                            collect(old('roles'))->contains($role->id)
                        )
                            checked
                        @endif
                    >

                    <label class="form-check-label" for="role{{ $role->id }}">
                        {{ $role->name }}
                    </label>
                </div>
            @endforeach
        </div>
        {!! $errors->first('roles', '<div class="invalid-feedback d-block"><strong>:message</strong></div>') !!}
    </div>

    {{-- model_type oculto --}}
    <input type="hidden" name="model_type" value="App\Models\User">

    <button class="btn btn-primary w-100 rounded-3 py-2 fw-bold">
        Guardar
    </button>
</div>
