<?php

namespace App\Http\Controllers;

use App\Models\ActividadEconomica;
use Illuminate\Http\Request;

class ActividadEconomicaController extends Controller
{
    public function getActividadesEconomicas()
    {
        return ActividadEconomica::all();
    }
}
