<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::create([
            'nombres' => 'Administrador',
            'apellidos' => 'Sistema',
            'correo_electronico' => 'admin@example.com',
            'numero_identificacion' => '1234567890',
            'tipo_identificacion' => 'Cedula de Ciudadania',
            'contrasena' => Hash::make('123456'),
            'rol_id' => 1,
        ]);
        \App\Models\User::create([
            'nombres' => 'Instructor',
            'apellidos' => 'SENA',
            'correo_electronico' => 'instructor@example.com',
            'numero_identificacion' => '1234567890',
            'tipo_identificacion' => 'Cedula de Ciudadania',
            'contrasena' => Hash::make('123456'),
            'rol_id' => 2,
        ]);
        \App\Models\User::factory(5)->create();
    }
}
