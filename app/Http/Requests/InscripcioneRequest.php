<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\Infante;
use App\Models\Curso;

class InscripcioneRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $inscripcionId = $this->route('inscripcione');

        return [
            'infante_id' => [
                'required',
                'integer',
                'exists:infantes,infante_id',
            ],
            'curso_id' => [
                'required',
                'integer',
                'exists:cursos,curso_id',
            ],
            'turno_id' => [
                'required',
                'integer',
                'exists:turnos,turno_id',
            ],
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if (!$this->infante_id || !$this->curso_id || !$this->turno_id) {
                return;
            }

            $infante = Infante::find($this->infante_id);
            $curso   = Curso::with('nivel', 'sala', 'inscripciones')->find($this->curso_id);

            if (!$infante || !$curso) {
                return;
            }

            // 1) Verificar si el infante ya está inscrito en cualquier curso y turno este año
            $yaInscrito = $infante->inscripciones()
                ->whereYear('fecha', now()->year)
                ->exists();

            if ($yaInscrito) {
                $validator->errors()->add('infante_id', 'Este infante ya está inscrito.');
            }

            // 2) Validar edad para el curso
            if ($curso->nivel) {
                $edad = \Carbon\Carbon::parse($infante->fecha_nacimiento_infante)->age;
                if ($edad < $curso->nivel->edad_minima || $edad > $curso->nivel->edad_maxima) {
                    $validator->errors()->add('infante_id', "Edad del infante ($edad años) fuera del rango permitido para este curso ({$curso->nivel->edad_minima}-{$curso->nivel->edad_maxima}).");
                }
            }

            // 3) Validar capacidad de la sala
            if ($curso->sala) {
                $capacidad = $curso->sala->capacidad_maxima ?? 0;
                $inscritos = $curso->inscripciones()->count();
                if ($inscritos >= $capacidad) {
                    $validator->errors()->add('curso_id', "No hay espacio suficiente en la sala {$curso->sala->nombre_sala}.");
                }
            }
        });
    }

    public function messages(): array
    {
        return [
            'infante_id.required' => 'Debe seleccionar un infante.',
            'infante_id.integer' => 'El infante seleccionado es inválido.',
            'infante_id.exists' => 'El infante seleccionado no existe en la base de datos.',

            'curso_id.required' => 'Debe seleccionar un curso.',
            'curso_id.integer' => 'El curso seleccionado es inválido.',
            'curso_id.exists' => 'El curso seleccionado no existe en la base de datos.',

            'turno_id.required' => 'Debe seleccionar un turno.',
            'turno_id.integer' => 'El turno seleccionado es inválido.',
            'turno_id.exists' => 'El turno seleccionado no existe en la base de datos.',
        ];
    }
}
