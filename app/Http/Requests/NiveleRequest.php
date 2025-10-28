<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
			'nombre_nivel' => 'required|string',
            'edad_minima' => 'nullable|integer|min:0',
            'edad_maxima' => 'nullable|integer|min:0',
            'estado' => 'required|in:activo,inactivo',
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
            'nombre_nivel.required' => 'El nombre del nivel es obligatorio.',
            'edad_minima.integer' => 'La edad mínima debe ser un número entero.',
            'edad_maxima.integer' => 'La edad máxima debe ser un número entero.',
			'estado' => 'required',
        ];
    }
}
