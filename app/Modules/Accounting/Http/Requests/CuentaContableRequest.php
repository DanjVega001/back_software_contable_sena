<?php

namespace App\Modules\Accounting\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CuentaContableRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() : bool
    {
        return \Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() : array
    {
        return [
            'codigo' => 'numeric|required',
            'nombre' => 'required|string',
            'descripcion' => 'nullable|string',
            'nivel' => 'required|string',
            'naturaleza' => 'required|string',
            'padre_id' => 'required|numeric|exists:cuentas_contables,id',
            'empresa_serial' => 'required|exists:empresas,serial|numeric',
        ];
    }
}
