<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDetalleAsistenciaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'asistencia_id' => 'required|exists:asistencias,id',
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
