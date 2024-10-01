<?php

namespace App\Modules\Settings\Third\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ContactoRequest extends FormRequest
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
            'datos_contactos' => 'nullable|array',
            'datos_contactos.*.nombre' => 'required|string',
            'datos_contactos.*.apellido' => 'nullable|string',
            'datos_contactos.*.correo_electronico' => 'nullable|email',
            'datos_contactos.*.telefono' => 'nullable|numeric',
        ];
    }
}
