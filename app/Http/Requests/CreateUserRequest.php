<?php

namespace App\Http\Requests;

use App\Providers\AuthServiceProvider;
use App\Rules\UniqueUserEmail;
use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $role = AuthServiceProvider::getRole();
        return $role === AuthServiceProvider::admin || $role === AuthServiceProvider::instructor;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = request()->route('instructor_id') ?? request()->route('aprendiz_id');
        return [
            'nombres' => 'required|string',
            'apellidos' => 'required|string',
            'correo_electronico' => ['required','string','email', $id == null ? 'unique:users' : new UniqueUserEmail($id)],
            'tipo_identificacion' => 'required|string',
            'numero_identificacion' => 'required|numeric',
            'contrasena' => 'string'
        ];
    }
}
