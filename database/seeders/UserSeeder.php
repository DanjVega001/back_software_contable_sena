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
            'nombres' => 'Instructor 1',
            'apellidos' => 'SENA',
            'correo_electronico' => 'instructor1@example.com',
            'numero_identificacion' => '1234567891',
            'tipo_identificacion' => 'Cedula de Ciudadania',
            'contrasena' => Hash::make('123456'),
            'rol_id' => 2,
        ]);
        \App\Models\User::create([
            'nombres' => 'Instructor 2',
            'apellidos' => 'SENA',
            'correo_electronico' => 'instructor2@example.com',
            'numero_identificacion' => '1234567892',
            'tipo_identificacion' => 'Cedula de Ciudadania',
            'contrasena' => Hash::make('123456'),
            'rol_id' => 2,
        ]);
        \App\Models\User::create([
            'nombres' => 'Instructor 3',
            'apellidos' => 'SENA',
            'correo_electronico' => 'instructor3@example.com',
            'numero_identificacion' => '1234567893',
            'tipo_identificacion' => 'Cedula de Ciudadania',
            'contrasena' => Hash::make('123456'),
            'rol_id' => 2,
        ]);
        \App\Models\User::create([
            'nombres' => 'Instructor 4',
            'apellidos' => 'SENA',
            'correo_electronico' => 'instructor4@example.com',
            'numero_identificacion' => '1234567894',
            'tipo_identificacion' => 'Cedula de Ciudadania',
            'contrasena' => Hash::make('123456'),
            'rol_id' => 2,
        ]);
        \App\Models\User::create([
            'nombres' => 'Instructor 5',
            'apellidos' => 'SENA',
            'correo_electronico' => 'instructor5@example.com',
            'numero_identificacion' => '1234567895',
            'tipo_identificacion' => 'Cedula de Ciudadania',
            'contrasena' => Hash::make('123456'),
            'rol_id' => 2,
        ]);
        \App\Models\User::factory(5)->create();
    }
}
