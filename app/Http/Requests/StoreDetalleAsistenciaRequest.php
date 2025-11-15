<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Asistencia;
use App\Models\Inscripcione;

class StoreDetalleAsistenciaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'asistencia_id' => [
                'required',
                'exists:asistencias,id',
                function ($attribute, $value, $fail) {
                    $asistencia = Asistencia::with('detalleAsistencias.inscripcion')->find($value);

                    if (!$asistencia) return;

                    foreach ($asistencia->detalleAsistencias as $detalle) {
                        $curso_id = $detalle->inscripcion->curso_id;
                        $turno_id = $detalle->inscripcion->turno_id;
                        $fecha = $asistencia->fecha;

                        // Verificar si ya existe una asistencia para el mismo curso, turno y fecha
                        $existe = Asistencia::where('fecha', $fecha)
                            ->whereHas('detalleAsistencias.inscripcion', function($q) use ($curso_id, $turno_id) {
                                $q->where('curso_id', $curso_id)
                                  ->where('turno_id', $turno_id);
                            })
                            ->exists();

                        if ($existe) {
                            $fail('Ya se generó la lista de asistencia para este curso, turno y fecha.');
                            break;
                        }
                    }
                }
            ],
            'inscripcion_id' => 'required|exists:inscripciones,id',
            'observacion' => 'required|in:presente,ausente,licencia',
        ];
    }

    public function messages(): array
    {
        return [
            'asistencia_id.required' => 'El ID de asistencia es obligatorio.',
            'asistencia_id.exists' => 'El ID de asistencia no existe.',
            'inscripcion_id.required' => 'El ID de inscripción es obligatorio.',
            'inscripcion_id.exists' => 'El ID de inscripción no existe.',
            'observacion.required' => 'Debe seleccionar una observación.',
            'observacion.in' => 'La observación debe ser uno de los siguientes valores: presente, ausente, licencia.',
        ];
    }
}
