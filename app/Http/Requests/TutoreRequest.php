<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TutoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $tutoreId = $this->route('tutore');

        return [
            'nombre_tutor' => [
                'required', 'string', 'max:50',
                'regex:/^[\p{L}\s]+$/u',
            ],
            'apellido_tutor' => [
                'required', 'string', 'max:50',
                'regex:/^[\p{L}\s]+$/u',
            ],
            'CI_tutor' => [
                'required', 'string', 'max:20',
                Rule::unique('tutores', 'CI_tutor')->ignore($tutoreId),
            ],
            'telefono_tutor' => [
                'nullable', 'string', 'max:20',
                'regex:/^(\+\d{1,3})?\d{6,15}$/',
            ],
            'correo_electronico_tutor' => [
                'required', 'string', 'email', 'max:100',
                Rule::unique('tutores', 'correo_electronico_tutor')->ignore($tutoreId),
                Rule::unique('users', 'email')->ignore($tutoreId, 'tutor_id'), // 👈 agregado
            ],
            'direccion_tutor' => [
                'nullable', 'string', 'max:255',
            ],
            'password' => [
                $this->isMethod('post') ? 'required' : 'nullable',
                'confirmed',
                'min:6'
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'nombre_tutor.required' => 'El nombre del tutor es obligatorio.',
            'nombre_tutor.regex' => 'El nombre solo puede contener letras y espacios.',
            'apellido_tutor.required' => 'El apellido del tutor es obligatorio.',
            'apellido_tutor.regex' => 'El apellido solo puede contener letras y espacios.',
            'CI_tutor.required' => 'El número de carnet es obligatorio.',
            'CI_tutor.unique' => 'Este número de carnet ya está registrado.',
            'correo_electronico_tutor.required' => 'El correo electrónico es obligatorio.',
            'correo_electronico_tutor.email' => 'El formato del correo electrónico es inválido.',
            'correo_electronico_tutor.unique' => 'Este correo ya está asociado a otro usuario o tutor.',
            'password.required' => 'Debe establecer una contraseña.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
            'password.min' => 'La contraseña debe tener al menos 6 caracteres.',
        ];
    }
}
