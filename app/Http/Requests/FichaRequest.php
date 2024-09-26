<?php

namespace App\Http\Requests;

use App\Providers\AuthServiceProvider;
use App\Rules\UniqueNumberFicha;
use Illuminate\Foundation\Http\FormRequest;

class FichaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $role = AuthServiceProvider::getRole();
        return $role === AuthServiceProvider::instructor || $role === AuthServiceProvider::admin;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $number = request("numero");
        return [
            'codigo' => 'required|numeric|integer|digits_between:4,10',
            'numero' => ['required','numeric','integer','digits_between:4,10',new UniqueNumberFicha()],
            'programa' => 'required|string',
        ];
    }
}
