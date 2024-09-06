<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
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

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_create_aprendiz()
    {
        $response = $this->postJson('/api/aprendiz', [
            'nombres' => 'Jane',
            'apellidos' => 'Doe',
            'correo_electronico' => 'daniel.vega03@hotmail.com',
            'tipo_identificacion' => 'Pasaporte',
            'numero_identificacion' => 2004313102,
        ], $this->headers());

        $response->assertStatus(201);
    }

    public function test_create_instructor()
    {
        $response = $this->postJson('/api/instructor', [
            'nombres' => 'Jhon',
            'apellidos' => 'Doe',
            'correo_electronico' => 'danjvega@soy.sena.edu.co',
            'tipo_identificacion' => 'Cedula de Ciudadadnia',
            'numero_identificacion' => 200423232,
        ], $this->headers());

        $response->assertStatus(201);
    }
}
