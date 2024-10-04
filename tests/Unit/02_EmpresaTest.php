<?php

namespace Tests\Unit;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class EmpresaTest extends TestCase
{

    public static $serial;

    private function headers(): array
    {
        return [
            'Authorization' => 'Bearer ' . LoginTest::$token,
            'Content-Type' => 'multipart/form-data',
            'Accept' => 'application/json'
        ];
    }

    private function updateData(array $data): array
    {
        Storage::fake('public');
        $file = UploadedFile::fake()->image('certificado.jpg');
        $data['datos_basicos']['telefono'] = 200000;
        $data['datos_basicos']['ciudad_codigo_dian'] = 5002;
        $data['datos_basicos']['razon_social'] = "EMpresa test 2";
        $data['datos_tributarios']['es_agente_retenedor'] = true;
        $data['representante_legal']['nombres'] = 'Jhon Doe';
        $data['datos_empresa']['correo_contacto'] = '|22112@example.com';
        $data['datos_empresa']['logo'] = $file;
        return $data;
    }

    private function getData(): array
    {
        Storage::fake('public');
        $file = UploadedFile::fake()->image('certificado.jpg');
        return [
            'datos_basicos' => [
                'tipo_razon_social' => 'Empresa',
                'tipo_identificacion' => 'NIT',
                'numero_identificacion' => '123456789',
                'razon_social' => 'Empresa Test',
                'nombre_comercial' => 'Empresa Test',
                'direccion' => 'Calle 123, Casa 123',
                'telefono' => 123456789,
                'ciudad_codigo_dian' => 5001
            ],
            'datos_empresa' => [
                'tipo_regimen_iva' => 'No responable IVA',
                'correo_contacto' => 'admin@example.com',
                'nombre_contacto' => 'Administrador',
                'es_consorcio' => false,
                'cobrador_id' => 1,
                'pagina_web' => 'http://www.example.com',
                'logo' => $file,
                //'logo' => 'logo.png',
                //'user_id' => 7 // Nullable (Si no se envia se intuye que el que crea la empresa es el que esta autenticado)
            ],
            'datos_tributarios' => [
                'tarifa_ica' => 45,
                'maneja_aiu' => false,
                'utiliza_dos_impuestos' => false,
                'es_agente_retenedor' => false,
                'maneja_impuesto_ad_valorem' => false,
                'moneda_extranjera' => false,
                'tributos' => [3, 7],
                'actividad_economica_codigo_ciiu' => 10,
                'responsabilidades_fiscales' => ['0-47', 'O-15']
            ],
            'representante_legal' => [
                'apellidos' => 'Apellido Legal',
                'nombres' => 'Nombre Legal',
                'tipo_identificacion' => 'Cédula',
                'numero_identificacion' => 123456789,
                'tiene_socios' => true,
                'lista_socios' => '{"socios": [{"nombre": "Socio 1", "apellido": "Apellido 1", "identificacion": "123456789", "parentesco": "Conyuge"}]}'
            ]
        ];
    }

    private function getRandomSerialCompany() : int
    {
        return DB::table('empresas')->inRandomOrder()->where('user_id', '=', 2)->first('serial')->serial;
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */



    public function test_create_company()
    {
        $response = $this->postJson('/api/company', $this->getData(), $this->headers());
        $response->assertStatus(201);
        EmpresaTest::$serial = $response->json('serial');
    }


/*
    public function test_update_company()
    {
        $response = $this->putJson('/api/update-company/' . $this->getRandomSerialCompany(), $this->updateData($this->getData()), $this->headers());
        $response->assertStatus(200);
    }

    /*

    public function test_delete_company()
    {
        $response = $this->deleteJson('/api/delete-company/' . $this->getRandomSerialCompany(), [], $this->headers());
        $response->assertStatus(200);
    }
    */

}
