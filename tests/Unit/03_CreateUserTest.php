<?php

namespace Tests\Unit;

use Faker\Factory as FakerFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Tests\TestCase;

class CreateUserTest extends TestCase
{


    private function headers(): array
    {
        return [
            'Authorization' => 'Bearer ' . LoginTest::$token,
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];
    }


    public function test_create_instructor()
    {
        $faker = FakerFactory::create();

        $response = $this->postJson('/api/instructor', [
            'nombres' => $faker->firstName(),
            'apellidos' => $faker->lastName(),
            'correo_electronico' => $faker->email(),
            'tipo_identificacion' => 'Pasaporte',
            'numero_identificacion' => $faker->numberBetween(7),
        ], $this->headers());

        $response->assertStatus(201);
    }
}
