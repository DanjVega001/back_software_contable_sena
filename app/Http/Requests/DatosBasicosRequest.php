<?php

namespace App\Http\Requests;

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

    /*
    public function messages()
    {
        return [
            "tipo_razon_social.required" => "El campo razón social es obligatorio.",
            "tipo_identificacion.required" => "El campo tipo de identificación es obligatorio.",
            "numero_identificacion.required" => "El campo número de identificación es obligatorio.",
            "razon_social.required" => "El campo razón social es obligatorio.",
            "nombres.required" => "El campo nombres es obligatorio.",
            "apellidos.required" => "El campo apellidos es obligatorio.",
            "nombre_comercial.required" => "El campo nombre comercial es obligatorio.",
            "direccion.required" => "El campo dirección es obligatorio.",
            "telefono.required" => "El campo teléfono es obligatorio.",
            "ciudad_codigo_dian.required" => "El campo código de la ciudad es obligatorio"
        ];
    }*/
}
