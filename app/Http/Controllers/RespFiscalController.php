<?php

namespace App\Http\Controllers;

use App\Models\ResponsabilidadFiscal;
use Illuminate\Http\Request;

class RespFiscalController extends Controller
{
    public function getRespFiscal()
    {
        return response()->json(ResponsabilidadFiscal::all());
    }
}
