<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Tutore;

class VistaTutorController extends Controller
{
    /**
     * Mostrar el dashboard del tutor con sus infantes asignados, inscripciones y asistencias
     */
    public function index()
    {
        $usuario = Auth::user();

        // Traer tutor logueado con todos los infantes, sus inscripciones y registros de asistencia
        $tutor = Tutore::with([
            'infantes.inscripciones.curso',
            'infantes.inscripciones.turno',
            'infantes.inscripciones.detalleAsistencias.asistencia'
        ])->where('user_id', $usuario->id)->first();

        if (!$tutor) {
            abort(403, 'No se encontró información del tutor.');
        }

        return view('vista_tutor.dashboard', compact('tutor'));
    }
}
