<?php

namespace App\Repositories;

use App\Models\DatoBasico;

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
}
