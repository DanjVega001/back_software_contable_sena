<?php

namespace App\Repositories;

use App\Models\DatoTributario;

class DatosTributariosRepository
{
    public function saveTributaryData(array $data) : void
    {
        $tributaryData = new DatoTributario($data);
        $tributaryData->save();
        $tributaryData->responsabilidadesFiscales()->sync($data['responsabilidades_fiscales']);
        $tributaryData->tributos()->sync($data['tributos']);
    }

    public function updateTributaryData(DatoTributario $tributaryData, array $data) : void
    {
        $tributaryData->update($data);
        $tributaryData->responsabilidadesFiscales()->sync($data['responsabilidades_fiscales']);
        $tributaryData->tributos()->sync($data['tributos']);
    }

    public function deleteTributaryData(DatoTributario $tributaryData) : void
    {
        $tributaryData->responsabilidadesFiscales()->detach();
        $tributaryData->tributos()->detach();
        $tributaryData->delete();
    }

}
