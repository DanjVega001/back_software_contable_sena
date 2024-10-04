<?php

namespace App\Modules\Shared\Http\Requests;

use App\Providers\AuthServiceProvider;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class DatosBasicosRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() : bool
    {
        $method = request()->method();
        $nameRoute = request()->route()->getName();
        if (($nameRoute && $nameRoute == 'create.third') || $method == 'PUT') {
            return Auth::check();
        }
        if ($method == 'POST') {
            $role = AuthServiceProvider::getRole();
            return $role === AuthServiceProvider::admin || $role === AuthServiceProvider::instructor;
        }
        return false;
    }


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() : array
    {
        return [
            "datos_basicos.tipo_razon_social" => "required|string",
            "datos_basicos.tipo_identificacion" => "required|string",
            "datos_basicos.numero_identificacion" => "required|numeric",
            "datos_basicos.razon_social" => "nullable|string",
            "datos_basicos.nombres" => "nullable|string",
            "datos_basicos.apellidos" => "nullable|string",
            "datos_basicos.nombre_comercial" => "required|string",
            "datos_basicos.direccion" => "required|string",
            "datos_basicos.telefono" => "required|numeric",
            "datos_basicos.ciudad_codigo_dian" => "required|numeric",
        ];
    }


    public function messages() : array
    {
        return [
            "datos_basicos.tipo_razon_social.required" => "El campo tipo razón social es obligatorio.",
            "datos_basicos.tipo_identificacion.required" => "El campo tipo de identificación es obligatorio.",
            "datos_basicos.numero_identificacion.required" => "El campo número de identificación es obligatorio.",
            "datos_basicos.razon_social.required" => "El campo razón social es obligatorio.",
            "datos_basicos.nombres.required" => "El campo nombres es obligatorio.",
            "datos_basicos.apellidos.required" => "El campo apellidos es obligatorio.",
            "datos_basicos.nombre_comercial.required" => "El campo nombre comercial es obligatorio.",
            "datos_basicos.direccion.required" => "El campo dirección es obligatorio.",
            "datos_basicos.telefono.required" => "El campo teléfono es obligatorio.",
            "datos_basicos.ciudad_codigo_dian.required" => "El campo código de la ciudad es obligatorio"
        ];
    }
}
