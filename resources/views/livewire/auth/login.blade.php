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


<div class="min-h-screen flex items-center justify-center bg-[#011126] relative">

    {{-- Overlay --}}
    <div class="absolute inset-0 bg-[#034C8C]/80"></div>

    {{-- Caja del formulario --}}
    <div class="relative z-10 w-full max-w-md p-8 rounded-xl shadow-2xl" style="background: linear-gradient(145deg, #034C8C, #023059);">

        {{-- Título --}}
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-[#6CAFD9]">Guardería Los Pequeños</h1>
            <p class="text-[#84B8D9] mt-2 text-sm">Acceso al sistema de administración</p>
        </div>

        {{-- Estado de sesión --}}
        <x-auth-session-status class="mb-4 text-[#6CAFD9]" :status="session('status')" />

        {{-- Formulario --}}
        <form wire:submit="login" class="space-y-6">

            <flux:input
                wire:model="email"
                label="Correo electrónico"
                type="email"
                required
                autofocus
                placeholder="correo@ejemplo.com"
                class="w-full text-white bg-[#023059]/80 border-[#6CAFD9] focus:border-[#84B8D9] focus:ring-[#84B8D9]"
            />

            <flux:input
                wire:model="password"
                label="Contraseña"
                type="password"
                required
                placeholder="Contraseña"
                viewable
                class="w-full text-white bg-[#023059]/80 border-[#6CAFD9] focus:border-[#84B8D9] focus:ring-[#84B8D9]"
            />

            <div class="flex items-center justify-between">
                <flux:checkbox wire:model="remember" label="Recuérdame" class="text-[#84B8D9]" />
                @if(Route::has('register'))
                    <a href="{{ route('register') }}" class="text-[#6CAFD9] hover:text-[#84B8D9] text-sm">Regístrate aquí</a>
                @endif
            </div>

            <flux:button type="submit" class="w-full py-3 font-bold text-lg bg-[#6CAFD9] hover:bg-[#84B8D9] transition duration-200">
                Ingresar
            </flux:button>

        </form>
    </div>
</div>