<?php

namespace Tests\Unit;

use App\Providers\AuthServiceProvider;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class EmpresaTest extends TestCase
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
    public function test_create_company()
    {
        
        $response = $this->postJson('/api/create-company', [
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
                'pagina_web' => 'http://www.example.com',
                'logo' => 'logo.png',
                'user_id' => 7
            ],
            'datos_tributarios' => [
                'tarifa_ica' => 45,
                'maneja_aiu' => false,
                'utiliza_dos_impuestos' => false,
                'es_agente_retenedor' => false,
                'maneja_impuesto_ad_valorem' => false,
                'moneda_extranjera' => false,
                'tributos' => '{"impuesto_general": 10, "impuesto_renta": 5, "impuesto_renta_patrimonial": 0}',
                'actividad_economica_codigo_ciiu' => 6300,
                'responsabilidades_fiscales' => ['0-47', 'O-15']
            ],
            'representante_legal' => [
                'apellidos' => 'Apellido Legal',
                'nombres' => 'Nombre Legal',
                'tipo_identificacion' => 'Cédula',
                'numero_identificacion' => 123456789,
                'tiene_socios' => true
            ]
        ], $this->headers());


        $response->assertStatus(201);
    }
}
