<?php

namespace Database\Seeders;

use App\Models\Ficha;
use App\Models\User;
use Illuminate\Database\Seeder;

class FichaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ficha = new Ficha([
            'codigo' => '12345',
            'numero' => '1',
            'programa' => 'Programa 1',
        ]);
        $ficha->save();

        $aprendices = User::whereHas('role', function ($query) {
            $query->where('nombre', '=', 'aprendiz');
        })->select('id as user_id')->get()->toArray();

        $aprendices = array_map(function ($ap) {
            $ap['rol'] = 'aprendiz';
            return $ap;
        }, $aprendices);

        $ficha->users()->attach(
            $aprendices
        );
    }
}
