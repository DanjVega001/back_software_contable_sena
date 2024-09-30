<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TributosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tributos = [
            ['nombre' => 'IVA'],
            ['nombre' => 'IC'],
            ['nombre' => 'INC'],
            ['nombre' => 'ReteIVA'],
            ['nombre' => 'Reterenta'],
            ['nombre' => 'ReteICA'],
            ['nombre' => 'FtoHorticultura'],
            ['nombre' => 'Timbre'],
            ['nombre' => 'INC Bolsas'],
            ['nombre' => 'INCarbono'],
            ['nombre' => 'INcombustibles'],
            ['nombre' => 'Sobretasa Combustibles'],
            ['nombre' => 'Sordicom'],
            ['nombre' => 'Nombre de la figura tributaria'],
            ['nombre' => 'IC Porcentual'],
        ];
        DB::table('tributos')->insert($tributos);
    }
}
