<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'correo_electronico' => 'required|string|exists:users|email',
            'contrasena' => 'required|string',
        ];
    }


    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    
    public function messages()
    {
        return [
            'correo_electronico.required' => 'El campo de correo electrónico es obligatorio.',
            'correo_electronico.string' => 'El correo electrónico debe ser un texto válido.',
            'correo_electronico.exists' => 'El correo electrónico no está registrado.',
            'correo_electronico.email' => 'El correo electrónico es invalido',
            'contrasena.required' => 'La contraseña es obligatoria.',
            'contrasena.string' => 'La contraseña debe ser un texto válido.',
        ];
    }
}
