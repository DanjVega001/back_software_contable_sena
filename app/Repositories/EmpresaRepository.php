<?php

namespace App\Repositories;

use App\Models\DatoBasico;
use App\Models\DatoTributario;
use App\Models\Empresa;
use App\Models\RepresentanteLegal;

class EmpresaRepository 
{

    public function saveBasicData(array $data) : int
    {
        $basicData = new DatoBasico($data);
        $basicData->save();
        return $basicData->id;
    }

    public function saveCompany(array $data) : int
    {
        $company = new Empresa($data);
        $company->save();
        return $company->serial;
    }

    public function saveTributaryData(array $data) : int
    {
        $tributaryData = new DatoTributario($data);
        $tributaryData->save();
        $tributaryData->responsabilidadesFiscales()->sync($data['responsabilidades_fiscales']);
        return $tributaryData->id;
    }

    public function saveLegalRepresentative(array $data) : int
    {
        $legalRepresentative = new RepresentanteLegal($data);
        $legalRepresentative->save();
        return $legalRepresentative->id;
    }

    public function serialExists(int $serial) : bool
    {
        return Empresa::where('serial', $serial)->exists();
    }
}
