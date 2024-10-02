<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    protected $model = \App\Modules\Shared\Models\User::class;

    public function definition()
    {
        return [
            'nombres' => $this->faker->name(),
            'correo_electronico' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'contrasena' => Hash::make("123456"),
            'apellidos' => $this->faker->lastName(),
            'tipo_identificacion' => 'Cedula de Ciudadania',
            'numero_identificacion' => $this->faker->randomNumber(),
            'remember_token' => Str::random(10),
            'rol_id' => 3,
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
