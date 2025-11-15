<div class="row p-1">
    <div class="col-md-12">
        <!-- Nombre -->
        <div class="form-group mb-3">
            <label for="name" class="form-label">{{ __('Nombre') }}</label>
            <input 
                type="text" 
                name="name" 
                class="form-control @error('name') is-invalid @enderror" 
                value="{{ old('name', $user?->name) }}" 
                id="name" 
                placeholder="Nombre completo"
                required>
            {!! $errors->first('name', '<div class="invalid-feedback"><strong>:message</strong></div>') !!}
        </div>

        <!-- Email -->
        <div class="form-group mb-3">
            <label for="email" class="form-label">{{ __('Correo electrónico') }}</label>
            <input 
                type="email" 
                name="email" 
                class="form-control @error('email') is-invalid @enderror" 
                value="{{ old('email', $user?->email) }}" 
                id="email" 
                placeholder="usuario@correo.com"
                required>
            {!! $errors->first('email', '<div class="invalid-feedback"><strong>:message</strong></div>') !!}
        </div>

        <!-- Rol -->
        <div class="form-group mb-3">
            <label for="role_id" class="form-label">{{ __('Rol del usuario') }}</label>
            <select 
                name="role_id" 
                id="role_id" 
                required 
                class="form-control @error('role_id') is-invalid @enderror">
                <option value="">Seleccione rol</option>
                @foreach($roles as $role)
                    <option value="{{ $role->id }}" {{ old('role_id', $user?->role_id) == $role->id ? 'selected' : '' }}>
                        {{ $role->name }}
                    </option>
                @endforeach
            </select>
            {!! $errors->first('role_id', '<div class="invalid-feedback"><strong>:message</strong></div>') !!}
        </div>

        <!-- Contraseña -->
        <div class="form-group mb-3">
            <label for="password" class="form-label">{{ __('Contraseña') }}</label>
            <div class="input-group">
                <input 
                    type="password" 
                    name="password" 
                    class="form-control @error('password') is-invalid @enderror" 
                    id="password" 
                    placeholder="Contraseña (mínimo 8 caracteres)"
                    {{ isset($user) ? '' : 'required' }}>
                <button type="button" class="btn btn-outline-secondary" onclick="togglePassword()">Mostrar</button>
            </div>
            {!! $errors->first('password', '<div class="invalid-feedback"><strong>:message</strong></div>') !!}
        </div>
    </div>

    <!-- Botón Guardar -->
    <div class="col-md-12 mt-3">
        <button type="submit" class="btn btn-primary">{{ __('Guardar') }}</button>
        <a href="{{ route('users.index') }}" class="btn btn-secondary">Cancelar</a>
    </div>
</div>

<script>
function togglePassword() {
    const input = document.getElementById('password');
    input.type = input.type === 'password' ? 'text' : 'password';
}
</script>
