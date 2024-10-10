<?php

namespace App\Modules\Accounting\Http\Controllers;

use App\Modules\Accounting\Models\CuentaContable;
use App\Modules\Accounting\Utils\Constants\AccountConstants;
use Illuminate\Http\JsonResponse;

class CuentaContableController
{

    public function buildPuc($empresa_serial) : JsonResponse
    {
        return response()->json(CuentaContable::with('descendants')
            ->where('nivel', '=', AccountConstants::classAccName)->get());
    }
}
