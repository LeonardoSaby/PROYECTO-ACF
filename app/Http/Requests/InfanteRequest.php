<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

class InfanteRequest extends FormRequest
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
     */
    public function rules(): array
    {
        $infanteId = $this->route('infante'); // id del infante para editar

        return [
            'nombre_infante' => [
                'required',
                'string',
                'max:50',
                'regex:/^[\p{L}\s]+$/u',
                Rule::unique('infantes', 'nombre_infante')
                    ->where(function ($query) {
                        return $query->where('apellido_infante', $this->apellido_infante)
                                     ->where('fecha_nacimiento_infante', $this->fecha_nacimiento_infante);
                    })
                    ->ignore($infanteId, 'infante_id'), // ← especificamos la columna PK
            ],
            'apellido_infante' => [
                'required',
                'string',
                'max:50',
                'regex:/^[\p{L}\s]+$/u',
            ],
            'CI_infante' => [
                'required',
                'string',
                'max:20',
                Rule::unique('infantes', 'CI_infante')->ignore($infanteId, 'infante_id'), // ← columna PK
            ],
            'fecha_nacimiento_infante' => [
                'required',
                'date',
                function ($attribute, $value, $fail) {
                    $edad = Carbon::parse($value)->age;
                    if ($edad > 6) {
                        $fail('No se puede registrar un infante mayor de 6 años.');
                    }
                }
            ],
            'genero_infante' => 'required|string|in:Masculino,Femenino,Otro',
        ];
    }

    /**
     * Get custom messages for the validation rules.
     */
    public function messages(): array
    {
        return [
            'nombre_infante.required' => 'El **Nombre del Infante** es obligatorio.',
            'nombre_infante.unique' => 'Ya existe un infante registrado con el mismo nombre, apellido y fecha de nacimiento. Verifique los datos.',
            'nombre_infante.string' => 'El Nombre del Infante debe ser una cadena de texto.',
            'nombre_infante.max' => 'El Nombre del Infante no debe exceder los 50 caracteres.',
            'nombre_infante.regex' => 'El Nombre del Infante solo puede contener letras y espacios.',

            'apellido_infante.required' => 'El **Apellido del Infante** es obligatorio.',
            'apellido_infante.string' => 'El Apellido del Infante debe ser una cadena de texto.',
            'apellido_infante.max' => 'El Apellido del Infante no debe exceder los 50 caracteres.',
            'apellido_infante.regex' => 'El Apellido del Infante solo puede contener letras y espacios.',

            'CI_infante.required' => 'La **Cédula de Identidad (CI)** es obligatoria.',
            'CI_infante.string' => 'La CI debe ser una cadena de texto.',
            'CI_infante.max' => 'La CI no debe exceder los 20 caracteres.',
            'CI_infante.unique' => 'Esta **Cédula de Identidad** ya se encuentra registrada para otro infante.',

            'fecha_nacimiento_infante.required' => 'La **Fecha de Nacimiento** es obligatoria.',
            'fecha_nacimiento_infante.date' => 'La Fecha de Nacimiento debe ser una fecha válida.',

            'genero_infante.required' => 'El **Género** del infante es obligatorio.',
            'genero_infante.string' => 'El Género debe ser una cadena de texto.',
            'genero_infante.in' => 'El Género seleccionado no es válido.',
        ];
    }
}
