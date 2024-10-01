<?php

namespace App\Modules\Settings\Third\Http\Requests;

use App\Providers\AuthServiceProvider;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class TerceroRequest extends FormRequest
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
            'empresa_serial' => 'required|exists:empresas,serial|numeric',
            'datos_terceros.codigo_sucursal' => 'nullable|numeric',
            'datos_terceros.tipo_tercero' => 'required|array',
            'datos_terceros.tipo_tercero.*' => 'required|exists:tipo_terceros,id|numeric',
        ];
    }
}
