<?php

namespace App\Modules\Settings\Third\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class DatosFacturacionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() : bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() : array
    {
        return [
            'datos_facturacion' => 'nullable',
            'datos_facturacion.nombres_contacto' => 'required|string',
            'datos_facturacion.apellidos_contacto' => 'nullable|string',
            'datos_facturacion.correo_electronico' => 'nullable|email',
            'datos_facturacion.tipo_regimen_iva' => 'required|string',
            'datos_facturacion.telefono' => 'nullable|numeric',
            'datos_facturacion.codigo_postal' => 'nullable|numeric',
            'datos_facturacion.responsabilidades_fiscales' => 'required|array',
            'datos_facturacion.responsabilidades_fiscales.*' => 'required|string|exists:responsabilidades_fiscales,codigo',
        ];
    }
}
