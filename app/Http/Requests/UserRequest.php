<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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
    public function rules()
{
    $userId = $this->route('user')?->id; // obtiene el ID del usuario desde la ruta (update)

    return [
        'name' => [
            'required',
            'string',
            'max:255',
            'regex:/^[a-zA-Z\s]+$/',
        ],
        'email' => [
            'required',
            'email',
            Rule::unique('users')->ignore($userId),
        ],
        'password' => 'nullable|min:6',
        'rol_id' => 'required|exists:roles,id',
    ];
}
public function messages()
{
    return [
        'name.required' => 'El nombre es obligatorio.',
        'name.string' => 'El nombre debe ser una cadena de texto.',
        'name.max' => 'El nombre no debe exceder los 255 caracteres.',
        'name.regex' => 'El nombre solo debe contener letras y espacios.',
        'email.required' => 'El correo electrónico es obligatorio.',
        'email.email' => 'El correo electrónico debe ser una dirección válida.',
        'email.unique' => 'El correo electrónico ya está en uso.',
        'password.min' => 'La contraseña debe tener al menos 6 caracteres.',
        'rol_id.required' => 'El rol es obligatorio.',
        'rol_id.exists' => 'El rol seleccionado no es válido.',
    ];
}
}
