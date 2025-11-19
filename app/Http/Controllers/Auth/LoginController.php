<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Redirigir usuarios después del login según su rol
     */
    protected function authenticated(Request $request, $user)
    {
        // Si el usuario tiene únicamente el rol de Tutor
        if ($user->hasRole('Tutor') && $user->roles->count() === 1) {
            return redirect()->route('tutor.vista');
        }

        // Para otros roles, redirigir al dashboard normal
        return redirect()->route('dashboard');
    }

    /**
     * Crear una nueva instancia del controlador.
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }
}
