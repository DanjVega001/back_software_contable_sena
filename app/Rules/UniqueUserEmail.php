<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class UniqueUserEmail implements Rule
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
        return !\App\Modules\Shared\Models\User::where('correo_electronico', $value)->exists() ||
            \App\Modules\Shared\Models\User::find($this->user_id)->correo_electronico == $value;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Email ya existe';
    }
}
