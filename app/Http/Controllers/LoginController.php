<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    // Redirige al usuario después de iniciar sesión
    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        // Esta es la línea que debes modificar
        // Retornará la vista que acabas de crear
        return view('auth.login_personalizado');
    }

    // El resto del código del controlador se encarga automáticamente de la autenticación
}