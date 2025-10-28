<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DocenteRequest extends FormRequest
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
			'nombre_docente' => [
                'required',
                'string',
                'max:50',
                'regex:/^[\p{L}\s]+$/u' // Permite solo letras y espacios
            ],
			'apellido_docente' => 'required|string',
			'telefono_docente' => 'required|string',
			'CI_docente' => 'required',
			'correo_electronico_docente' => 'required|string',
			'estado' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'nombre_docente.required' => 'El nombre del docente es obligatorio.',
            'nombre_docente.string' => 'El nombre del docente debe ser una cadena de texto.',
            'nombre_docente.max' => 'El nombre del docente no debe exceder los 50 caracteres.',
            'nombre_docente.regex' => 'El nombre del docente solo debe contener letras y espacios.',
            'apellido_docente.required' => 'El apellido del docente es obligatorio.',
            'apellido_docente.string' => 'El apellido del docente debe ser una cadena de texto.',
            'telefono_docente.required' => 'El teléfono del docente es obligatorio.',
            'telefono_docente.string' => 'El teléfono del docente debe ser una cadena de texto.',
            'CI_docente.required' => 'La cédula de identidad del docente es obligatoria.',
            'correo_electronico_docente.required' => 'El correo electrónico del docente es obligatorio.',
            'correo_electronico_docente.string' => 'El correo electrónico del docente debe ser una cadena de texto.',
            'estado.required' => 'El estado es obligatorio.',
        ];
    }
}
