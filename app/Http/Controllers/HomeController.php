<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Infante;
use App\Models\Tutore;
use App\Models\DetalleAsistencia;
use App\Models\Inscripcione;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // Calcular distribución de edades por nuevos rangos: 1-3 y 4-6
        $edades = Infante::all()->map(function($infante) {
            $edad = Carbon::parse($infante->fecha_nacimiento_infante)->age;
            if ($edad >= 1 && $edad <= 3) return '1-3';
            if ($edad >= 4 && $edad <= 6) return '4-6';
            return 'Mayor de 6'; // opcional, para control si alguien excede edad
        })->countBy()->sortKeys();

        $totalInfantes = Inscripcione::count();

        $presentesHoy = DetalleAsistencia::whereDate('created_at', today())
                            ->where('observacion', 'presente')
                            ->count();

        $porcentajeAsistencia = $totalInfantes ? round(($presentesHoy / $totalInfantes) * 100) : 0;
        $porcentajeAusencia = 100 - $porcentajeAsistencia;

        $proximoCumple = Infante::orderByRaw("DATE_FORMAT(fecha_nacimiento_infante, '%m-%d') >= DATE_FORMAT(NOW(), '%m-%d') ASC")
                            ->first();

        return view('home', compact(
            'totalInfantes',
            'presentesHoy',
            'porcentajeAsistencia',
            'porcentajeAusencia',
            'proximoCumple',
            'edades'
        ));
    }
}
