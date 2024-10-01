<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(RolSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(FichaSeeder::class);
        $this->call(CiudadesSeeder::class);
        $this->call(ResponsabilidadesFiscalesSeeder::class);
        $this->call(ActividadesEconomicasSeeder::class);
        $this->call(TributosSeeder::class);
        $this->call(TipoTerceroSeeder::class);
    }
}
