<?php


namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DetalleAsistenciaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id_asistencia' => [
                'required',
                'integer',
                'exists:asistencias,id'
            ],
            'id_inscripcion' => [
                'required',
                'integer',
                'exists:inscripciones,id',
                // Regla única compuesta: no permitir la misma combinación de id_asistencia e id_inscripcion
                Rule::unique('detalle_asistencias')->where(function ($query) {
                    return $query->where('id_asistencia', $this->id_asistencia)
                                ->where('id_inscripcion', $this->id_inscripcion);
                })->ignore($this->route('detalle_asistencia')), // Ignorar el registro actual en edición
            ],
            'observaciones' => 'required|string',
            'estado' => 'required',
        ];
    }

    public function messages()
    {   
        return [
            'id_asistencia.required' => 'El campo Asistencia es obligatorio.',
            'id_inscripcion.required' => 'El campo Inscripción es obligatorio.',
            'id_inscripcion.unique' => 'Este infante ya tiene registrada su asistencia para esta fecha.',
            'observaciones.required' => 'El campo Observaciones es obligatorio.',
            'estado.required' => 'El campo Estado es obligatorio.',
        ];
    }
}