<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CiudadesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $ciudades = [
            ['codigo_dian' => '05001', 'nombre' => 'Medellín'],
            ['codigo_dian' => '05002', 'nombre' => 'Abejorral'],
            ['codigo_dian' => '05004', 'nombre' => 'Abriaquí'],
            ['codigo_dian' => '05021', 'nombre' => 'Alejandría'],
            ['codigo_dian' => '05030', 'nombre' => 'Amagá'],
            ['codigo_dian' => '05031', 'nombre' => 'Amalfi'],
            ['codigo_dian' => '05034', 'nombre' => 'Andes'],
            ['codigo_dian' => '05036', 'nombre' => 'Angelópolis'],
            ['codigo_dian' => '05038', 'nombre' => 'Angostura'],
            ['codigo_dian' => '05040', 'nombre' => 'Anorí'],
            ['codigo_dian' => '05042', 'nombre' => 'Santafé de Antioquia'],
            ['codigo_dian' => '05044', 'nombre' => 'Anzá'],
            ['codigo_dian' => '05045', 'nombre' => 'Apartadó'],
            ['codigo_dian' => '05051', 'nombre' => 'Arboletes'],
            ['codigo_dian' => '05055', 'nombre' => 'Argelia'],
            ['codigo_dian' => '05059', 'nombre' => 'Armenia'],
            ['codigo_dian' => '05079', 'nombre' => 'Barbosa'],
            ['codigo_dian' => '05086', 'nombre' => 'Belmira'],
            ['codigo_dian' => '05088', 'nombre' => 'Bello'],
            ['codigo_dian' => '05091', 'nombre' => 'Betania'],
            ['codigo_dian' => '05093', 'nombre' => 'Betulia'],
            ['codigo_dian' => '05101', 'nombre' => 'Ciudad Bolívar'],
            ['codigo_dian' => '05107', 'nombre' => 'Briceño'],
            ['codigo_dian' => '05113', 'nombre' => 'Buriticá'],
            ['codigo_dian' => '05120', 'nombre' => 'Cáceres'],
            ['codigo_dian' => '05125', 'nombre' => 'Caicedo'],
            ['codigo_dian' => '05129', 'nombre' => 'Caldas'],
            ['codigo_dian' => '05134', 'nombre' => 'Campamento'],
            ['codigo_dian' => '05138', 'nombre' => 'Cañasgordas'],
            ['codigo_dian' => '05142', 'nombre' => 'Caracolí'],
            ['codigo_dian' => '05145', 'nombre' => 'Caramanta'],
            ['codigo_dian' => '05147', 'nombre' => 'Carepa'],
            ['codigo_dian' => '05148', 'nombre' => 'El Carmen de Viboral'],
            ['codigo_dian' => '05150', 'nombre' => 'Carolina del Príncipe'],
            ['codigo_dian' => '05154', 'nombre' => 'Caucasia'],
            ['codigo_dian' => '05172', 'nombre' => 'Chigorodó'],
            ['codigo_dian' => '05190', 'nombre' => 'Cisneros'],
            ['codigo_dian' => '05197', 'nombre' => 'Cocorná'],
            ['codigo_dian' => '05206', 'nombre' => 'Concepción'],
            ['codigo_dian' => '05209', 'nombre' => 'Concordia'],
            ['codigo_dian' => '05212', 'nombre' => 'Copacabana'],
            ['codigo_dian' => '05234', 'nombre' => 'Dabeiba'],
            ['codigo_dian' => '05237', 'nombre' => 'Donmatías'],
            ['codigo_dian' => '05240', 'nombre' => 'Ebéjico'],
            ['codigo_dian' => '05250', 'nombre' => 'El Bagre'],
            ['codigo_dian' => '05264', 'nombre' => 'Entrerríos'],
            ['codigo_dian' => '05266', 'nombre' => 'Envigado'],
            ['codigo_dian' => '05282', 'nombre' => 'Fredonia'],
            ['codigo_dian' => '05284', 'nombre' => 'Frontino'],
            ['codigo_dian' => '05306', 'nombre' => 'Giraldo'],
            ['codigo_dian' => '05308', 'nombre' => 'Girardota'],
            ['codigo_dian' => '05310', 'nombre' => 'Gómez Plata'],
            ['codigo_dian' => '05313', 'nombre' => 'Granada'],
            ['codigo_dian' => '05315', 'nombre' => 'Guadalupe'],
            ['codigo_dian' => '05318', 'nombre' => 'Guarne'],
            ['codigo_dian' => '05321', 'nombre' => 'Guatapé'],
            ['codigo_dian' => '05347', 'nombre' => 'Heliconia'],
            ['codigo_dian' => '05353', 'nombre' => 'Hispania'],
            ['codigo_dian' => '05360', 'nombre' => 'Itagüí'],
            ['codigo_dian' => '05361', 'nombre' => 'Ituango'],
            ['codigo_dian' => '05364', 'nombre' => 'Jardín'],
            ['codigo_dian' => '05368', 'nombre' => 'Jericó'],
            ['codigo_dian' => '05376', 'nombre' => 'La Ceja'],
            ['codigo_dian' => '05380', 'nombre' => 'La Estrella'],
            ['codigo_dian' => '05390', 'nombre' => 'La Pintada'],
            ['codigo_dian' => '05400', 'nombre' => 'La Unión'],
            ['codigo_dian' => '05411', 'nombre' => 'Liborina'],
            ['codigo_dian' => '05425', 'nombre' => 'Maceo'],
            ['codigo_dian' => '05440', 'nombre' => 'Marinilla'],
            ['codigo_dian' => '05467', 'nombre' => 'Montebello'],
            ['codigo_dian' => '05475', 'nombre' => 'Murindó'],
            ['codigo_dian' => '05480', 'nombre' => 'Mutatá'],
            ['codigo_dian' => '05483', 'nombre' => 'Nariño'],
            ['codigo_dian' => '05490', 'nombre' => 'Necoclí'],
            ['codigo_dian' => '05495', 'nombre' => 'Nechí'],
            ['codigo_dian' => '05501', 'nombre' => 'Olaya'],
            ['codigo_dian' => '05541', 'nombre' => 'Peñol'],
            ['codigo_dian' => '05543', 'nombre' => 'Peque'],
            ['codigo_dian' => '05576', 'nombre' => 'Pueblorrico'],
            ['codigo_dian' => '05579', 'nombre' => 'Puerto Berrío'],
            ['codigo_dian' => '05585', 'nombre' => 'Puerto Nare'],
            ['codigo_dian' => '05591', 'nombre' => 'Puerto Triunfo'],
            ['codigo_dian' => '05604', 'nombre' => 'Remedios'],
            ['codigo_dian' => '05607', 'nombre' => 'Retiro'],
            ['codigo_dian' => '05615', 'nombre' => 'Rionegro'],
            ['codigo_dian' => '05628', 'nombre' => 'Sabanalarga'],
            ['codigo_dian' => '05631', 'nombre' => 'Sabaneta'],
            ['codigo_dian' => '05642', 'nombre' => 'Salgar'],
            ['codigo_dian' => '05647', 'nombre' => 'San Andrés de Cuerquía'],
            ['codigo_dian' => '05649', 'nombre' => 'San Carlos'],
            ['codigo_dian' => '05652', 'nombre' => 'San Francisco'],
            ['codigo_dian' => '05656', 'nombre' => 'San Jerónimo'],
            ['codigo_dian' => '05658', 'nombre' => 'San José de la Montaña'],
            ['codigo_dian' => '05659', 'nombre' => 'San Juan de Urabá'],
            ['codigo_dian' => '05660', 'nombre' => 'San Luis'],
            ['codigo_dian' => '05664', 'nombre' => 'San Pedro de Urabá'],
            ['codigo_dian' => '05665', 'nombre' => 'San Pedro de los Milagros'],
            ['codigo_dian' => '05667', 'nombre' => 'San Rafael'],
            ['codigo_dian' => '05670', 'nombre' => 'San Roque'],
            ['codigo_dian' => '05674', 'nombre' => 'San Vicente Ferrer'],
            ['codigo_dian' => '05679', 'nombre' => 'Santa Bárbara'],
            ['codigo_dian' => '05686', 'nombre' => 'Santa Rosa de Osos'],
            ['codigo_dian' => '05690', 'nombre' => 'Santo Domingo'],
            ['codigo_dian' => '05697', 'nombre' => 'El Santuario'],
            ['codigo_dian' => '05736', 'nombre' => 'Segovia'],
            ['codigo_dian' => '05756', 'nombre' => 'Sonsón'],
            ['codigo_dian' => '05761', 'nombre' => 'Sopetrán'],
            ['codigo_dian' => '05789', 'nombre' => 'Támesis'],
            ['codigo_dian' => '05790', 'nombre' => 'Tarazá'],
            ['codigo_dian' => '05792', 'nombre' => 'Tarso'],
            ['codigo_dian' => '05809', 'nombre' => 'Titiribí'],
        ];

        DB::table('ciudades')->insert($ciudades);
    }
}