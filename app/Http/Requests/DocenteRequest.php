<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DocenteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $docenteId = $this->route('docente');

        return [
            'nombre_docente' => [
                'required',
                'string',
                'max:50',
                'regex:/^[\p{L}\s]+$/u',
            ],
            'apellido_docente' => [
                'required',
                'string',
                'max:50',
                'regex:/^[\p{L}\s]+$/u',
            ],
            'telefono_docente' => [
                'nullable',
                'string',
                'max:20',
                'regex:/^[0-9\s\+\(\)-]+$/',
            ],
            'CI_docente' => [
                'required',
                'string',
                'max:20',
                Rule::unique('docentes', 'CI_docente')->ignore($docenteId),
            ],
            'fecha_contratacion' => 'nullable|date',
            'correo_electronico_docente' => [
                'required',
                'string',
                'email',
                'max:100',
                Rule::unique('docentes', 'correo_electronico_docente')->ignore($docenteId),
            ],
            'estado' => 'nullable|string|in:activo,inactivo',
            'curso_id' => [
                'required',
                'integer',
                'exists:cursos,curso_id',
                // Se eliminó la regla unique para permitir varios docentes por curso
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
            'nombre_docente.required' => 'El **Nombre** del docente es obligatorio.',
            'nombre_docente.string' => 'El Nombre debe ser una cadena de texto.',
            'nombre_docente.max' => 'El Nombre no debe exceder los 50 caracteres.',
            'nombre_docente.regex' => 'El Nombre solo debe contener letras y espacios.',

            'apellido_docente.required' => 'El **Apellido** del docente es obligatorio.',
            'apellido_docente.string' => 'El Apellido debe ser una cadena de texto.',
            'apellido_docente.max' => 'El Apellido no debe exceder los 50 caracteres.',
            'apellido_docente.regex' => 'El Apellido solo debe contener letras y espacios.',

            'telefono_docente.string' => 'El Teléfono debe ser una cadena de texto.',
            'telefono_docente.max' => 'El Teléfono no debe exceder los 20 caracteres.',
            'telefono_docente.regex' => 'El formato del Teléfono no es válido.',

            'CI_docente.required' => 'La **Cédula de Identidad (CI)** es obligatoria.',
            'CI_docente.string' => 'La CI debe ser una cadena de texto.',
            'CI_docente.max' => 'La CI no debe exceder los 20 caracteres.',
            'CI_docente.unique' => 'Ya existe un docente registrado con esta Cédula de Identidad (CI).',

            'correo_electronico_docente.required' => 'El **Correo Electrónico** del docente es obligatorio.',
            'correo_electronico_docente.string' => 'El Correo Electrónico debe ser una cadena de texto.',
            'correo_electronico_docente.email' => 'El Correo Electrónico debe tener un formato válido (ejemplo@dominio.com).',
            'correo_electronico_docente.max' => 'El Correo Electrónico no debe exceder los 100 caracteres.',
            'correo_electronico_docente.unique' => 'Ya existe un docente registrado con este Correo Electrónico.',

            'estado.string' => 'El valor del estado debe ser texto.',
            'estado.in' => 'El valor del estado no es válido (solo activo o inactivo).',

            'curso_id.required' => 'El **Curso** asociado es obligatorio.',
            'curso_id.integer' => 'El ID del curso debe ser un número entero.',
            'curso_id.exists' => 'El curso asociado no existe en la base de datos.',

            'password.required' => 'Debe establecer una contraseña.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
            'password.min' => 'La contraseña debe tener al menos 6 caracteres.',
        ];
    }
}
