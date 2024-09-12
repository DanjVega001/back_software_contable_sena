<?php

namespace App\Http\Requests;

use App\Providers\AuthServiceProvider;
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
        return $role === AuthServiceProvider::instructor;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'codigo' => 'required|integer',
            'numero' => 'required|integer|unique:fichas',
            'programa' => 'required|string',
        ];
    }
}
