<?php

namespace App\Http\Controllers;

use App\Models\Inscripcione;
use App\Models\Curso;
use App\Models\Turno;
use App\Models\Asistencia;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class ReporteController extends Controller
{
                    // Vista HTML de la lista general de inscritos
    public function vistaListaGeneral()
    {
        $inscritos = Inscripcione::with(['infante', 'curso', 'turno'])->get();
        return view('reportes.lista_general', compact('inscritos'));
    }

                    // Genera el PDF de la lista general
    public function listaGeneralPDF()
    {
        $inscritos = Inscripcione::with(['infante', 'curso', 'turno'])->get();
        $pdf = Pdf::loadView('reportes.lista_general_pdf', compact('inscritos'));
        return $pdf->stream('lista_general_inscritos.pdf');
    }
                    // Formulario de filtrado
    public function formFiltrar()
    {
        $cursos = Curso::all();
        $turnos = Turno::all();
        return view('reportes.form_filtrar', compact('cursos', 'turnos'));
    }
                    // Genera PDF filtrado por curso y turno
    public function listaFiltradaPDF(Request $request)
    {
        $request->validate([
            'curso_id' => 'required|exists:cursos,curso_id',
            'turno_id' => 'required|exists:turnos,turno_id',
        ]);
        $inscritos = Inscripcione::with(['infante', 'curso', 'turno'])
                        ->where('curso_id', $request->curso_id)
                        ->where('turno_id', $request->turno_id)
                        ->get();
        $curso = Curso::find($request->curso_id);
        $turno = Turno::find($request->turno_id);
        $pdf = Pdf::loadView('reportes.lista_filtrada_pdf', compact('inscritos', 'curso', 'turno'));
        return $pdf->stream('lista_inscritos_'.$curso->nombre_curso.'_'.$turno->nombre_turno.'.pdf');
    }
                    // Vista HTML de asistencias 
    public function vistaAsistencias()
        {
            $asistencias = Asistencia::with([
                'detalleAsistencias.inscripcion.infante',
                'detalleAsistencias.inscripcion.curso',
                'detalleAsistencias.inscripcion.turno'
            ])->orderBy('fecha', 'desc')->get();

            return view('reportes.asistencias', compact('asistencias'));
        }

                    // Genera PDF de una asistencia específica
    public function listaAsistenciaPDF($asistencia_id)
    {
        $asistencia = Asistencia::with([
            'detalleAsistencias.inscripcion.infante',
            'detalleAsistencias.inscripcion.curso',
            'detalleAsistencias.inscripcion.turno'
        ])->findOrFail($asistencia_id);
        $asistencias = collect([$asistencia]);
        $pdf = Pdf::loadView('reportes.asistencia_pdf', compact('asistencias'));
        return $pdf->stream('lista_asistencia_' . $asistencia->fecha . '.pdf');
    }

    // =======================
    // COMPROBANTE INDIVIDUAL
    // =======================

    // Vista general donde se elige qué comprobante generar
public function comprobanteIndex()
{
    // Obtenemos todas las inscripciones para listarlas
    $inscripciones = Inscripcione::with(['infante', 'curso', 'turno'])->get();

    // Retornamos la vista donde se elige el comprobante
    return view('reportes.comprobante', compact('inscripciones'));
}

    
    // Vista HTML del comprobante
    public function comprobanteView($inscripcion_id)
    {
        $inscripcion = Inscripcione::with(['infante.tutores', 'curso', 'turno'])
            ->findOrFail($inscripcion_id);

        $infante = $inscripcion->infante;
        $tutores = $infante->tutores; // colección de tutores
        $curso   = $inscripcion->curso;
        $turno   = $inscripcion->turno;

        return view('reportes.comprobante', compact('inscripcion', 'infante', 'tutores', 'curso', 'turno'));
    }

    // PDF del comprobante
    public function comprobante($inscripcion_id)
    {
        $inscripcion = Inscripcione::with(['infante.tutores', 'curso', 'turno'])
            ->findOrFail($inscripcion_id);

        $infante = $inscripcion->infante;
        $tutores = $infante->tutores; // colección de tutores
        $curso   = $inscripcion->curso;
        $turno   = $inscripcion->turno;

        $pdf = Pdf::loadView('reportes.comprobante_pdf', compact('inscripcion', 'infante', 'tutores', 'curso', 'turno'))
                ->setPaper('letter', 'portrait');

        return $pdf->stream('Comprobante_'.$infante->nombre_infante.'.pdf');
    }

}
