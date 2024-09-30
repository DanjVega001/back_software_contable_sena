<?php

namespace App\Http\Controllers;

use App\Models\ActividadEconomica;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ActividadEconomicaController extends Controller
{
    public function getActividadesEconomicas() : JsonResponse
    {
        return response()->json(ActividadEconomica::all());
    }
}
