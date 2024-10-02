<?php

namespace App\Modules\Settings\Third\Repositories;

use App\Modules\Settings\Third\Models\Tercero;

class TerceroRepository
{

    public function saveThird(int $empresa_serial, array $data) : int
    {
        $data['empresa_serial'] = $empresa_serial;
        $third = new Tercero($data);
        $third->save();
        $third->tipoTerceros()->attach($data['tipo_tercero']);
        return $third->id;
    }
}
