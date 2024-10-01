<?php

namespace App\Modules\Settings\Third\Repositories;

use App\Modules\Settings\Third\Models\DatoFacturacion;

class DatosFacturacionRepository
{

    public function saveBillingData(array $data)
    {
        $datosFacturacion = new DatoFacturacion($data);
        $datosFacturacion->save();
        $datosFacturacion->respFiscales()->attach($data['responsabilidades_fiscales']);
    }
}
