<?php

namespace App\Modules\Settings\Third\Repositories;

use App\Modules\Settings\Third\Models\Tercero;
use Illuminate\Database\Eloquent\Model;

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

    public function find(int $tercero_id, int $empresa_serial) : ?Tercero
    {
        $tercero = Tercero::with(['datosBasicos', 'datosFacturacion', 'contactos', 'tipoTerceros'])
            ->where('id', '=', $tercero_id)->where('empresa_serial', '=', $empresa_serial)->firstOrFail();
        if ($tercero instanceof Tercero) return $tercero;
        return null;
    }

    public function updateThird(Tercero $tercero, array $data)
    {
        $tercero->update($data);
    }

    public function deleteThird(Tercero $tercero) : void
    {
        $tercero->delete();
    }

    public function getAllThirds(int $empresa_serial)
    {
        return Tercero::where('empresa_serial', $empresa_serial)->with(['datosBasicos', 'datosFacturacion', 'contactos', 'tipoTerceros'])->get();
    }
}
