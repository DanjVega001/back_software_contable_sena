<?php

namespace App\Http\Requests;

use App\Providers\AuthServiceProvider;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class DatosEmpresaRequest extends FormRequest
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
            'datos_empresa.tipo_regimen_iva' => "required|string",
            'datos_empresa.correo_contacto' => "required|string",
            'datos_empresa.nombre_contacto' => "required|string",
            'datos_empresa.es_consorcio' => "nullable|boolean",
            'datos_empresa.pagina_web' => "nullable|url",
            'datos_empresa.logo' => "nullable|string",
            'datos_empresa.user_id' => "nullable|numeric|exists:users,id"
        ];
    }
}
