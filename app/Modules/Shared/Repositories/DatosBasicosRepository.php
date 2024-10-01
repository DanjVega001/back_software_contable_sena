<?php

namespace App\Modules\Shared\Repositories;

use App\Modules\Shared\Models\DatoBasico;

class DatosBasicosRepository
{

    public function saveBasicData(array $data) : int
    {
        $basicData = new DatoBasico($data);
        $basicData->save();
        return $basicData->id;
    }

    public function updateBasicData(DatoBasico $basicData, array $data) : void
    {
        $basicData->update($data);
    }

    public function deleteBasicData(DatoBasico $basicData) : void
    {
        $basicData->delete();
    }
}
