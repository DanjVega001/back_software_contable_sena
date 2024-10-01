<?php

namespace App\Modules\Settings\Company\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class TributoController extends Controller
{
    public function getTributos() : JsonResponse
    {
        return response()->json(\App\Modules\Settings\Company\Models\Tributo::all());
    }
}
