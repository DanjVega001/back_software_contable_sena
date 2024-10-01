<?php

namespace App\Modules\Shared\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Shared\Models\Ciudad;

class CiudadController extends Controller
{
    public function getCities()
    {
        return response()->json(Ciudad::all());
    }
}
