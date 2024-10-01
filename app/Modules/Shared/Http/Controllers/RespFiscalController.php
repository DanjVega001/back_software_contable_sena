<?php

namespace App\Modules\Shared\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Shared\Models\ResponsabilidadFiscal;

class RespFiscalController extends Controller
{
    public function getRespFiscal()
    {
        return response()->json(ResponsabilidadFiscal::all());
    }
}
