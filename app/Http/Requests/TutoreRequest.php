<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TutoreRequest extends FormRequest
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
			'nombre_tutor' => [
                'required',
                'string',
                'max:50',
                'regex:/^[\p{L}\s]+$/u' // Permite letras y espacios
            ],
			'apellido_tutor' => [
                'required',
                'string',
                'max:50',
                'regex:/^[\p{L}\s]+$/u' // Permite letras y espacios
            ],
			'CI_tutor' => 'string',
			'telefono_tutor' => 'string',
			'correo_electronico_tutor' => 'string',
			'direccion_tutor' => 'string',
			'estado' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'nombre_tutor.required' => 'El nombre del tutor es obligatorio.',
            'nombre_tutor.string' => 'El nombre del tutor debe ser una cadena de texto.',
            'nombre_tutor.max' => 'El nombre del tutor no debe exceder los 50 caracteres.',
            'nombre_tutor.regex' => 'El nombre del tutor solo puede contener letras y espacios.',

            'apellido_tutor.required' => 'El apellido del tutor es obligatorio.',
            'apellido_tutor.string' => 'El apellido del tutor debe ser una cadena de texto.',
            'apellido_tutor.max' => 'El apellido del tutor no debe exceder los 50 caracteres.',
            'apellido_tutor.regex' => 'El apellido del tutor solo puede contener letras y espacios.',

            'CI_tutor.string' => 'La cédula de identidad del tutor debe ser una cadena de texto.',

            'telefono_tutor.string' => 'El teléfono del tutor debe ser una cadena de texto.',

            'correo_electronico_tutor.string' => 'El correo electrónico del tutor debe ser una cadena de texto.',

            'direccion_tutor.string' => 'La dirección del tutor debe ser una cadena de texto.',

            'estado.required' => 'El estado es obligatorio.',
        ];
    }
}
