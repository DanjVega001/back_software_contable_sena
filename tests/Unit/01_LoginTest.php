<?php

namespace Tests\Unit;

use Tests\TestCase;

class LoginTest extends TestCase
{

    public static $token = '';
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_login()
    {
        /*
        $response = $this->postJson('/api/login', [
            'correo_electronico' => 'mzboncak@example.org',
            'contrasena' => '123456'
        ]);*/

        /*$response = $this->postJson('/api/login', [
            'correo_electronico' => 'instructor@example.com',
            'contrasena' => '123456'
        ]);*/

        $response = $this->postJson('/api/login', [
            'correo_electronico' => 'instructor1@example.com',
            'contrasena' => '123456'
        ]);

        LoginTest::$token = $response->json('access_token');

        $response->assertStatus(200);
    }
}
