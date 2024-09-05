<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ResponsabilidadesFiscalesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $responsabilidades_fiscales = [
            ['codigo' => '0-13', 'descripcion' => 'Gran contribuyente'],
            ['codigo' => 'O-15', 'descripcion' => 'Autorretenedor'],
            ['codigo' => '0-23', 'descripcion' => 'Agente de retención IVA'],
            ['codigo' => '0-47', 'descripcion' => 'Régimen simple de tributación'],
            ['codigo' => 'R-99-PN', 'descripcion' => 'No responsable'],
        ];
    
        DB::table('responsabilidades_fiscales')->insert($responsabilidades_fiscales);
    }
}
