<?php

namespace Database\Seeders;

use App\Modules\Settings\Third\Models\TipoTercero;
use Illuminate\Database\Seeder;

class TipoTerceroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         TipoTercero::create([
            'nombre' => 'Clientes'
        ]);

        TipoTercero::create([
            'nombre' => 'Proveedores'
        ]);

        TipoTercero::create([
            'nombre' => 'Otros'
        ]);
    }

}
