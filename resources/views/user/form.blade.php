@csrf

<div class="card shadow-lg border-0 p-4 rounded-4" style="max-width: 600px; margin:auto; background: #f8f9fc;">
    <h3 class="mb-4 text-center fw-bold">Formulario de Usuario</h3>

    {{-- Nombre --}}
    <div class="mb-3">
        <label for="name" class="form-label fw-semibold">Nombre</label>
        <input 
            type="text" 
            name="name" 
            id="name"
            class="form-control rounded-3"
            placeholder="Nombre"
            value="{{ old('name', $user->name ?? '') }}"
            required>
    </div>

    {{-- Email --}}
    <div class="mb-3">
        <label for="email" class="form-label fw-semibold">Email</label>
        <input 
            type="email" 
            name="email" 
            id="email"
            class="form-control rounded-3"
            placeholder="Email"
            value="{{ old('email', $user->email ?? '') }}"
            required>
    </div>

    {{-- Contraseña --}}
    <div class="mb-3">
        <label for="password" class="form-label fw-semibold">Contraseña</label>
        <input 
            type="password" 
            name="password"
            id="password"
            class="form-control rounded-3"
            placeholder="{{ isset($user) ? 'Dejar vacío para mantener actual' : 'Contraseña' }}"
            {{ isset($user) ? '' : 'required' }}>
    </div>

    {{-- Roles --}}
    <div class="mb-3">
        <label class="form-label fw-semibold">Asignar Roles</label>

        <div class="p-3 rounded-3" style="background:#fff; border:1px solid #ddd;">
            @foreach ($roles as $role)
                <div class="form-check mb-2">
                    <input 
                        class="form-check-input"
                        type="checkbox"
                        name="roles[]"
                        id="role{{ $role->id }}"
                        value="{{ $role->id }}"

                        {{-- Marcar roles que el usuario ya tiene --}}
                        @if( isset($user) && $user->roles->contains('id', $role->id) )
                            checked
                        @endif
                    >

                    <label class="form-check-label" for="role{{ $role->id }}">
                        {{ $role->name }}
                    </label>
                </div>
            @endforeach
        </div>
    </div>

    <button class="btn btn-primary w-100 rounded-3 py-2 fw-bold">
        Guardar
    </button>
</div>
