<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\Asistencia;

class StoreAsistenciaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'fecha' => [
                'required',
                'date',
                Rule::unique('asistencias')->where(function ($query) {
                    return $query
                        ->where('curso_id', $this->input('curso_id'))
                        ->where('turno_id', $this->input('turno_id'));
                }),
            ],
            'curso_id' => 'required|exists:cursos,id',
            'turno_id' => 'required|exists:turnos,id',
        ];
    }

    public function messages(): array
    {
        return [
            'fecha.required' => 'La fecha es obligatoria.',
            'fecha.date' => 'La fecha no es válida.',
            'fecha.unique' => 'Ya existe una lista de asistencia para este curso y turno en esta fecha.',
            'curso_id.required' => 'El curso es obligatorio.',
            'curso_id.exists' => 'El curso no existe.',
            'turno_id.required' => 'El turno es obligatorio.',
            'turno_id.exists' => 'El turno no existe.',
        ];
    }
}
