<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ActividadesEconomicasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ciiu_codes = [
            ['codigo_ciiu' => '1730', 'descripcion' => 'Acabado de productos textiles no producidos en la misma unidad de producción'],
            ['codigo_ciiu' => '2234', 'descripcion' => 'Acabado o recubrimiento'],
            ['codigo_ciiu' => '4540', 'descripcion' => 'Acondicionamiento de edificaciones y de obras civiles'],
            ['codigo_ciiu' => '0130', 'descripcion' => 'Actividad mixta (agrícola y pecuaria)'],
            ['codigo_ciiu' => '0129', 'descripcion' => 'Actividad pecuaria no especializada'],
            ['codigo_ciiu' => '6719', 'descripcion' => 'Actividades auxiliares de la administración financiera NCP'],
            ['codigo_ciiu' => '6700', 'descripcion' => 'Actividades auxiliares de la intermediación financiera'],
            ['codigo_ciiu' => '6710', 'descripcion' => 'Actividades auxiliares de la intermediación financiera, excepto los seguros y los fondos de pensiones y cesantías'],
            ['codigo_ciiu' => '6722', 'descripcion' => 'Actividades auxiliares de los fondos de pensiones y cesantías'],
            ['codigo_ciiu' => '6721', 'descripcion' => 'Actividades auxiliares de los seguros'],
            ['codigo_ciiu' => '6720', 'descripcion' => 'Actividades auxiliares de los seguros y de los fondos de pensiones y cesantías'],
            ['codigo_ciiu' => '7515', 'descripcion' => 'Actividades auxiliares de servicios para la administración pública en general'],
            ['codigo_ciiu' => '5252', 'descripcion' => 'Actividades comerciales de las casas de empeño o compraventas'],
            ['codigo_ciiu' => '6300', 'descripcion' => 'Actividades complementarias y auxiliares al transporte; actividades de agencias de viajes'],
            ['codigo_ciiu' => '6333', 'descripcion' => 'Actividades de aeropuertos'],
            ['codigo_ciiu' => '9220', 'descripcion' => 'Actividades de agencias de noticias'],
            ['codigo_ciiu' => '6340', 'descripcion' => 'Actividades de agencias de viajes y organizadores de viajes; actividades de asistencia a turistas NCP'],
            ['codigo_ciiu' => '8514', 'descripcion' => 'Actividades de apoyo diagnóstico'],
            ['codigo_ciiu' => '8515', 'descripcion' => 'Actividades de apoyo terapéutico'],
            ['codigo_ciiu' => '7421', 'descripcion' => 'Actividades de arquitectura e ingeniería y actividades conexas de asesoramiento técnico'],
            ['codigo_ciiu' => '7414', 'descripcion' => 'Actividades de asesoramiento empresarial y en materia de gestión'],
            ['codigo_ciiu' => '9100', 'descripcion' => 'Actividades de asociaciones NCP'],
            ['codigo_ciiu' => '9231', 'descripcion' => 'Actividades de bibliotecas y archivos'],
            ['codigo_ciiu' => '9230', 'descripcion' => 'Actividades de bibliotecas, archivos y museos y otras actividades culturales'],
            ['codigo_ciiu' => '9210', 'descripcion' => 'Actividades de cinematografía, radio y televisión y otras actividades de entretenimiento'],
            ['codigo_ciiu' => '6713', 'descripcion' => 'Actividades de comisionistas y corredores de valores'],
            ['codigo_ciiu' => '6595', 'descripcion' => 'Actividades de compra de cartera (factoring)'],
            ['codigo_ciiu' => '7412', 'descripcion' => 'Actividades de contabilidad, teneduría de libros y auditoría; asesoramiento en materia de impuestos'],
            ['codigo_ciiu' => '6412', 'descripcion' => 'Actividades de correo distintas de las actividades postales nacionales'],
            ['codigo_ciiu' => '7522', 'descripcion' => 'Actividades de defensa'],
            ['codigo_ciiu' => '2200', 'descripcion' => 'Actividades de edición e impresión y de reproducción de grabaciones'],
            ['codigo_ciiu' => '2210', 'descripcion' => 'Actividades de edición'],
        ];
        
        

        DB::table('actividades_economicas')->insert($ciiu_codes);
    }
}
