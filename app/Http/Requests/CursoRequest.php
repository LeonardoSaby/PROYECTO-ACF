<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CursoRequest extends FormRequest
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
        // Obtiene el ID del curso actual para ignorarlo en la validación unique
        $cursoId = $this->route('curso');

        return [
            'nombre_curso' => [
                'required',
                'string',
                'max:100', // Límite de longitud adecuado
                // 1. Unicidad del nombre del curso
                Rule::unique('cursos', 'nombre_curso')->ignore($cursoId),
            ],
            // 🔑 Validaciones de Claves Foráneas:
            'nivel_id' => [
                'required',
                'integer',
                // Asegura que el ID exista en la tabla 'niveles' usando 'nivel_id' como PK (según el error anterior)
                'exists:niveles,nivel_id',
            ],
            'sala_id' => [
                'required',
                'integer',
                // Asegura que el ID exista en la tabla 'salas' usando 'sala_id' como PK
                'exists:salas,sala_id',
                // 2. Unicidad de la sala (una sala por curso)
                Rule::unique('cursos', 'sala_id')->ignore($cursoId),
            ],
            // 💡 Asumiendo que también tienes un campo de estado:
            'estado' => 'nullable|string|in:activo,inactivo',
        ];
    }

    /**
     * Get custom messages for the validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            // --- Mensajes para 'nombre_curso' ---
            'nombre_curso.required' => 'El **Nombre del Curso** es obligatorio.',
            'nombre_curso.string' => 'El Nombre del Curso debe ser una cadena de texto.',
            'nombre_curso.max' => 'El Nombre del Curso no debe exceder los 100 caracteres.',
            'nombre_curso.unique' => 'Ya existe un curso registrado con el nombre **:input**.',

            // --- Mensajes para 'nivel_id' ---
            'nivel_id.required' => 'Debe seleccionar un **Nivel** para el curso.',
            'nivel_id.integer' => 'El ID del nivel debe ser un número entero.',
            'nivel_id.exists' => 'El nivel seleccionado no existe o no es válido.',

            // --- Mensajes para 'sala_id' ---
            'sala_id.required' => 'Debe seleccionar una **Sala** para el curso.',
            'sala_id.integer' => 'El ID de la sala debe ser un número entero.',
            'sala_id.exists' => 'La sala seleccionada no existe o no es válida.',
            'sala_id.unique' => 'La **Sala** seleccionada ya ha sido asignada a otro curso. No se puede asignar dos veces la misma sala.', // Mensaje de unicidad

            // --- Mensajes para 'estado' ---
            'estado.string' => 'El valor del estado debe ser texto.',
            'estado.in' => 'El valor del estado no es válido (solo activo o inactivo).',
        ];
    }
}