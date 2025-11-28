@csrf

<div class="card shadow-lg border-0 p-4 rounded-4" style="max-width: 600px; margin:auto; background: #f8f9fc;">
    <h3 class="mb-4 text-center fw-bold">{{ isset($user) ? 'Editar Usuario' : 'Registrar Usuario' }}</h3>

    {{-- Mostrar errores generales --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Nombre --}}
    <div class="mb-3">
        <label for="name" class="form-label fw-semibold">Nombre</label>
        <input 
            type="text" 
            name="name" 
            id="name"
            class="form-control rounded-3 @error('name') is-invalid @enderror"
            placeholder="Nombre"
            value="{{ old('name', $user->name ?? '') }}"
            required>
        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    {{-- Email --}}
    <div class="mb-3">
        <label for="email" class="form-label fw-semibold">Email</label>
        <input 
            type="email" 
            name="email" 
            id="email"
            class="form-control rounded-3 @error('email') is-invalid @enderror"
            placeholder="Email"
            value="{{ old('email', $user->email ?? '') }}"
            required>
        @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    {{-- Contraseña --}}
    <div class="mb-3">
        <label for="password" class="form-label fw-semibold">Contraseña</label>
        <input 
            type="password" 
            name="password"
            id="password"
            class="form-control rounded-3 @error('password') is-invalid @enderror"
            placeholder="{{ isset($user) ? '**********' : 'Contraseña' }}"
            {{ isset($user) ? '' : 'required' }}>
        @error('password')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    {{-- Confirmar Contraseña --}}
    <div class="mb-3">
        <label for="password_confirmation" class="form-label fw-semibold">Confirmar Contraseña</label>
        <input 
            type="password" 
            name="password_confirmation"
            id="password_confirmation"
            class="form-control rounded-3 @error('password_confirmation') is-invalid @enderror"
            placeholder="{{ isset($user) ? '**********' : 'Confirmar Contraseña' }}"
            {{ isset($user) ? '' : 'required' }}>
        @error('password_confirmation')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <button class="btn btn-primary w-100 rounded-3 py-2 fw-bold">
        Guardar
    </button>
</div>
