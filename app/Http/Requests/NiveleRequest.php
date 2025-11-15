<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class NiveleRequest extends FormRequest
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
            'nombre_nivel' => [
                'required',
                'string',
                'max:100', // Un límite de longitud razonable
                // Asegura que el nombre sea único en la tabla 'niveles'
                Rule::unique('niveles', 'nombre_nivel')->ignore($this->route('nivele')),
            ],
            'edad_minima' => [
                'nullable',
                'integer',
                'min:0', // La edad mínima no puede ser negativa
                'max:150', // Límite superior lógico para una edad
                // Valida que edad_minima sea menor o igual que edad_maxima si ambas están presentes
                'lte:edad_maxima', 
            ],
            'edad_maxima' => [
                'nullable',
                'integer',
                'min:0',
                'max:150',
                // Valida que edad_maxima sea mayor o igual que edad_minima si ambas están presentes
                'gte:edad_minima',
            ],
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
            // --- Mensajes para 'nombre_nivel' ---
            'nombre_nivel.required' => 'El **Nombre del Nivel** es obligatorio.',
            'nombre_nivel.string' => 'El Nombre del Nivel debe ser texto.',
            'nombre_nivel.max' => 'El Nombre del Nivel no debe exceder los **100 caracteres**.',
            'nombre_nivel.unique' => 'Ya existe un nivel registrado con el nombre **:input**.',
            
            // --- Mensajes para 'edad_minima' ---
            'edad_minima.integer' => 'La edad mínima debe ser un número entero.',
            'edad_minima.min' => 'La edad mínima debe ser de al menos :min años.',
            'edad_minima.max' => 'La edad mínima no debe ser mayor a :max años.',
            'edad_minima.lte' => 'La edad mínima debe ser **menor o igual** a la edad máxima.',

            // --- Mensajes para 'edad_maxima' ---
            'edad_maxima.integer' => 'La edad máxima debe ser un número entero.',
            'edad_maxima.min' => 'La edad máxima debe ser de al menos :min años.',
            'edad_maxima.max' => 'La edad máxima no debe ser mayor a :max años.',
            'edad_maxima.gte' => 'La edad máxima debe ser **mayor o igual** a la edad mínima.',
        ];
    }
}