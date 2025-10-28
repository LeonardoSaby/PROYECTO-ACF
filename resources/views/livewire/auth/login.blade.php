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

<div class="min-h-screen flex items-center justify-center p-4 sm:p-6 
            bg-[url('fondo.jpg')] 
            bg-cover bg-center bg-fixed relative">

    <div class="absolute inset-0 bg-black opacity-60"></div>

    <div class="w-full max-w-sm z-10"> <div class="text-center mb-10 relative">
            <h2 class="text-4xl font-extrabold text-white tracking-tight">
                Acceso al Sistema
            </h2>
            <p class="mt-3 text-sm text-gray-300">
Hola            </p>
        </div>

        <x-auth-session-status class="text-center mb-6 text-cyan-400 relative" :status="session('status')" />

        <form wire:submit="login" class="bg-gray-800/90 p-8 sm:p-10 rounded-xl shadow-2xl space-y-6 border border-gray-700 backdrop-blur-sm relative">

            <flux:input
                wire:model="email"
                label="Correo electrónico"
                type="email"
                required
                autofocus
                autocomplete="email"
                placeholder="correo@ejemplo.com"
                class="w-full text-white bg-gray-700 border-gray-600 focus:border-cyan-500 focus:ring-cyan-500"
            />

            <div class="relative">
                <flux:input
                    wire:model="password"
                    label="Contraseña"
                    type="password"
                    required
                    autocomplete="current-password"
                    placeholder="Contraseña"
                    viewable
                    class="w-full text-white bg-gray-700 border-gray-600 focus:border-cyan-500 focus:ring-cyan-500"
                />
            </div>

            <div class="flex items-center justify-between pt-2">
                <flux:checkbox wire:model="remember" label="Recuérdame" class="text-cyan-500" />

                @if (Route::has('register'))
                    <a
                        href="{{ route('register') }}"
                        class="text-sm font-medium text-cyan-400 hover:text-cyan-300 hover:underline transition duration-200"
                    >
                        Regístrate aquí
                    </a>
                @endif
            </div>

            <div class="pt-6">
                <flux:button variant="primary" type="submit" class="w-full justify-center py-3 text-lg font-bold bg-cyan-600 hover:bg-cyan-700 focus:ring-cyan-500 focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 transition duration-150">
                    Ingresar
                </flux:button>
            </div>
        </form>
    </div>
</div>