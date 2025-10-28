<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $fecha_limite = now()->subYears(7)->format('Y-m-d');
        return [
			'nombre_infante' => [
                'required',
                'string',
                'max:255',
                'regex:/^[\p{L}\s]+$/u', // Solo letras y espacios
            ],
			'apellido_infante' => [
                'required',
                'string',
                'max:255',
                'regex:/^[\p{L}\s]+$/u', // Solo letras y espacios
            ],
			'CI_infante' => 'required',
			'fecha_nacimiento_infante' => [
                'required',
                'date',
                'after:' . $fecha_limite,
            ],
			'genero_infante' => 'required|string',
			'estado' => 'required',
        ];
    }
    public function messages(): array
    {
        return [
            'nombre_infante.regex' => 'El nombre del infante solo puede contener letras y espacios.',
            'nombre_infante.required' => 'El nombre del infante es obligatorio.',
            'apellido_infante.regex' => 'El apellido del infante solo puede contener letras y espacios.',
            'apellido_infante.required' => 'El apellido del infante es obligatorio.',
            'CI_infante.required' => 'La cédula de identidad del infante es obligatoria.',
            
            
            'fecha_nacimiento_infante.required' => 'La fecha de nacimiento del infante es obligatoria.',
            'fecha_nacimiento_infante.after' => 'La edad del infante excede el límite de inscripción (debe ser menor a 7 años).',
          

            'genero_infante.required' => 'El género del infante es obligatorio.',
            'estado.required' => 'El estado del infante es obligatorio.',

            'CI_infante.unique' => 'La cédula de identidad del infante ya está en uso.',
        ];
    }
}
