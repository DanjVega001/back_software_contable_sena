<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class UniqueUserDocument implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    private $user_id;

    public function __construct(int $user_id)
    {
        $this->user_id = $user_id;
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
        return !\App\Modules\Shared\Models\User::where('numero_identificacion', $value)->exists() ||
            \App\Modules\Shared\Models\User::find($this->user_id)->numero_identificacion == $value;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Número de documento ya usado';
    }
}
