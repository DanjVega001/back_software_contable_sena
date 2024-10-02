<?php

namespace Tests\Unit;

use App\Modules\Settings\Company\Models\Empresa;
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


    private function updateData(array $data): array
    {
        $data['datos_basicos']['telefono'] = 200000;
        $data['datos_basicos']['ciudad_codigo_dian'] = 5002;
        $data['datos_basicos']['razon_social'] = "EMpresa test 2";
        $data['datos_terceros']['codigo_sucursal'] = 005;
        $data['datos_contactos'][0]['nombres'] = 'Jhon Doe';
        $data['datos_facturacion']['correo_electronico'] = '|22112@example.com';
        return $data;
    }

    private function idThird(): int
    {
        return \DB::table('terceros')->where('empresa_serial', '=', EmpresaTest::$serial)
            ->first()->id;
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

    public function test_update_third()
    {
        $response = $this->putJson('/api/update-third/' .$this->idThird(), $this->updateData($this->getData()), $this->headers());
        $response->assertStatus(200);
    }

    public function test_delete_third()
    {
        $response = $this->deleteJson('/api/delete-third/'. $this->idThird(), [
            "empresa_serial" => EmpresaTest::$serial
        ], $this->headers());
        $response->assertStatus(200);
    }
}
