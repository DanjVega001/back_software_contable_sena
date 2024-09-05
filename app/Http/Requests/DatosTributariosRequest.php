<?php

namespace App\Http\Requests;

use App\Providers\AuthServiceProvider;
use Illuminate\Foundation\Http\FormRequest;

class DatosTributariosRequest extends FormRequest
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
            'datos_tributarios.tarifa_ica' => 'required|integer',
            'datos_tributarios.maneja_aiu' => 'required|boolean',
            'datos_tributarios.utiliza_dos_impuestos' => 'required|boolean',
            'datos_tributarios.es_agente_retenedor' => 'required|boolean',
            'datos_tributarios.maneja_impuesto_ad_valorem' => 'required|boolean',
            'datos_tributarios.moneda_extranjera' => 'required|boolean',
            'datos_tributarios.tributos' => 'required|json',
            'datos_tributarios.actividad_economica_codigo_ciiu' => 'required|numeric|exists:actividades_economicas,codigo_ciiu',
            'datos_tributarios.responsabilidades_fiscales' => 'required|array',
        ];
    }
}
