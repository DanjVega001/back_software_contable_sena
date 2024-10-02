<?php

namespace App\Modules\Settings\User\Repositories;

use App\Modules\Settings\User\Models\Ficha;
use Facade\FlareClient\Http\Exceptions\NotFound;

class FichaRepository
{

    public function getFichaByNumero(int $numero) : Ficha
    {
        $ficha = Ficha::where('numero', $numero)->first();
        if (!$ficha) {
            throw new NotFound("Ficha $numero no encontrada");
        }
        return $ficha;
    }
}
