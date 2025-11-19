<?php

use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Volt\Component;

new #[Layout('components.layouts.auth')] class extends Component {
    #[Validate('required|string|email')]
    public string $email = '';

    #[Validate('required|string')]
    public string $password = '';

    public bool $remember = false;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->ensureIsNotRateLimited();

        if (! Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'email' => __('auth.failed'),
            ]);
        }

        RateLimiter::clear($this->throttleKey());
        Session::regenerate();

        $this->redirectIntended(default: route('home', absolute: false), navigate: false);
    }

    /**
     * Ensure the authentication request is not rate limited.
     */
    protected function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout(request()));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => __('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the authentication rate limiting throttle key.
     */
    protected function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->email).'|'.request()->ip());
    }
}; ?>


<div class="max-h-screen flex items-center justify-center bg-[#011126] relative">

    {{-- Overlay más suave --}}
    <div class="absolute inset-0 bg-[#034C8C]/50"></div>

    {{-- Caja del formulario con degradado --}}
    <div class="relative z-10 w-full max-w-md p-8 rounded-xl shadow-2xl backdrop-blur-md"
            style="background: linear-gradient(to bottom,rgba(0, 80, 141, 0.15),rgba(0, 80, 141, 0.95));">

        {{-- Logo --}}
        <div class="flex justify-center mb-4">
            <img src="{{ asset('images/logo_guarderia.png') }}" 
                    alt="Logo Guardería"
                    class="h-20 drop-shadow-xl">
        </div>

        {{-- Título --}}
        <div class="text-center mb-6">
            <h1 class="text-3xl font-bold text-[#A7D3F2]">Guardería Los Pequeños</h1>
            <p class="text-[#C0E0F4] mt-2 text-sm">Acceso al sistema de administración</p>
        </div>

        {{-- Estado de sesión --}}
        <x-auth-session-status class="mb-4 text-[#6cc1fd]" :status="session('status')" />

        {{-- Formulario --}}
        {{-- Formulario --}}
<form wire:submit="login" class="space-y-6 text-[#012a4a] text-base">

    <flux:input
        wire:model="email"
        label="Correo electrónico"
        type="email"
        required
        autofocus
        placeholder="correo@ejemplo.com"
        class="w-full text-[#012a4a] bg-[#E3F2FD] border-[#034C8C] 
               focus:border-[#012a4a] focus:ring-[#034C8C] text-sm"
    />

    <flux:input
        wire:model="password"
        label="Contraseña"
        type="password"
        required
        placeholder="Contraseña"
        viewable
        class="w-full text-[#012a4a] bg-[#E3F2FD] border-[#034C8C] 
               focus:border-[#012a4a] focus:ring-[#034C8C] text-sm"
    />

    <div class="flex items-center justify-between text-[#012a4a] text-base">
        <flux:checkbox wire:model="remember" label="Recuérdame" />
        @if(Route::has('register'))
            <a href="{{ route('register') }}" 
               class="text-[#023e7d] hover:text-[#0353a4] text-sm font-semibold">
                Regístrate aquí
            </a>
        @endif
    </div>

    <flux:button type="submit"
        class="w-full py-3 font-bold text-lg bg-[#023e7d] hover:bg-[#0353a4] text-white transition duration-200">
        Ingresar
    </flux:button>

</form>

    </div>
</div>
