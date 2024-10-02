<?php

namespace Database\Seeders;

use App\Modules\Auth\Models\Rol;
use Illuminate\Database\Seeder;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Rol::create([
            'nombre' => 'admin',
        ]);

        Rol::create([
            'nombre' => 'instructor',
        ]);

        Rol::create([
            'nombre' => 'aprendiz',
        ]);
    }
}
