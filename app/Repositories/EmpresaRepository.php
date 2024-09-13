<?php

namespace App\Repositories;

use App\Models\Empresa;

class EmpresaRepository 
{

    public function saveCompany(array $data) : int
    {
        $company = new Empresa($data);
        $company->save();
        return $data['serial'];
    }

    public function updateCompany(Empresa $empresa, array $data) : void
    { 
        $empresa->update($data);
    }
    
    public function serialExists(int $serial) : bool
    {
        return Empresa::where('serial', $serial)->exists();
    }

    public function deleteCompany(Empresa $empresa) : void
    {
        $empresa->delete();
    }

    public function getCompanyBySerial(int $serial) : Empresa
    {
        return Empresa::with(['datosBasicos', 'representanteLegal', 'datosTributarios', 'datosTributarios.responsabilidadesFiscales'])->where('serial', $serial)->first();
    }
}
