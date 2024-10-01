<?php

namespace App\Modules\Settings\Company\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Settings\Company\Models\ActividadEconomica;
use Illuminate\Http\JsonResponse;

class ActividadEconomicaController extends Controller
{
    public function getActividadesEconomicas() : JsonResponse
    {
        return response()->json(ActividadEconomica::all());
    }
}
