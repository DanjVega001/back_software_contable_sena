<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class TributoContoller extends Controller
{
    public function getTributos() : JsonResponse
    {
        return response()->json(\App\Models\Tributo::all());
    }
}
