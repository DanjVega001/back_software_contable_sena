<?php

namespace Tests\Unit;

use Tests\TestCase;


class TerceroTest extends TestCase
{

    private function headers(): array
    {
        return [
            'Authorization' => 'Bearer ' . LoginTest::$token,
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];
    }

    private function getData(): array
    {
        return [
            'empresa_serial' => EmpresaTest::$serial,
            'datos_basicos' => [
                'tipo_razon_social' => 'Empresa',
                'tipo_identificacion' => 'NIT',
                'numero_identificacion' => '123456789',
                'razon_social' => 'Empresa Tercera Test',
                'nombre_comercial' => 'Empresa Tercera Test',
                'direccion' => 'Calle 123, Casa 123',
                'telefono' => 123456789,
                'ciudad_codigo_dian' => 5001
            ],
            'datos_terceros' => [
                'codigo_sucursal' => 002,
                'tipo_tercero' => [
                    'id' => 1
                ]
            ],
            'datos_facturacion' => [
                'nombres_contacto' => "elPedro",
                'apellidos_contacto' => "false",
                'correo_electronico' => "false@example.com",
                'tipo_regimen_iva' => 'No responable IVA',
                'telefono' => 2222222,
                'codigo_postal' => 3355,
                'responsabilidades_fiscales' => ['0-47', 'O-15']
            ],
            'datos_contactos' => [
                0 => [
                    'nombre' => 'Apellido Legal',
                    'apellido' => 'Nombre Legal',
                    'correo_electronico' => 'Cédula@example.com',
                    'telefono' => 123456789,
                ],
            ]
        ];
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_create_third()
    {

        $response = $this->postJson('/api/create-third', $this->getData(), $this->headers());
        $response->assertStatus(201);

    }
}
