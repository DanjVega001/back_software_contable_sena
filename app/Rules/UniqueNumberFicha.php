<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class UniqueNumberFicha implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $numero = request("numero") ?? 0;
        if ($numero == 0) {
            return !\App\Modules\Settings\User\Models\Ficha::where('numero', $value)->exists();
        }
        if ($numero == $value) {
            return true;
        }
        return !\App\Modules\Settings\User\Models\Ficha::where('numero', $value)->exists();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Número de ficha ya existe.';
    }
}
