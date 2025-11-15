<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SalaRequest extends FormRequest
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
            'nombre_sala' => [
                'required',
                'string',
                'max:255',
                // Asegúrate de que 'salas' es el nombre correcto de la tabla
                \Illuminate\Validation\Rule::unique('salas')->ignore($this->route('sala')),
            ],
            'capacidad_maxima' => [
                'nullable',
                'integer',
            ],
        ];
    }

    // 💬 Nuevo método para los mensajes personalizados
    public function messages(): array
    {
        return [
            // --- Mensajes para 'nombre_sala' ---
            'nombre_sala.required' => 'El campo **Nombre de la Sala** es obligatorio.',
            'nombre_sala.string' => 'El Nombre de la Sala debe ser texto.',
            'nombre_sala.max' => 'El Nombre de la Sala no debe exceder los **255 caracteres**.',
            'nombre_sala.unique' => 'Ya existe una sala con el nombre **:input**. Por favor, elija uno diferente.',

            // --- Mensajes para 'capacidad_maxima' ---
            'capacidad_maxima.integer' => 'La Capacidad Máxima debe ser un **número entero**.',
            
        ];
    }
}