<?php

namespace App\Http\Requests;

use App\Providers\AuthServiceProvider;
use Illuminate\Foundation\Http\FormRequest;

class RepesentanteLegalRequest extends FormRequest
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
        return [
            'representante_legal.apellidos' => "required|string",
            'representante_legal.nombres' => "required|string",
            'representante_legal.tipo_identificacion' => "required|string",
            'representante_legal.numero_identificacion' => "required|numeric",
            'representante_legal.tiene_socios' => "required|boolean",
        ];
    }
}
