<?php

namespace App\Modules\Accounting\Http\Controllers;

use App\Modules\Accounting\Http\Requests\CuentaContableRequest;
use App\Modules\Accounting\Models\CuentaContable;
use App\Modules\Accounting\Services\CuentaContableService;
use App\Modules\Accounting\Utils\Constants\AccountConstants;
use Illuminate\Http\JsonResponse;

class CuentaContableController
{

    private $service;

    public function __construct(CuentaContableService $service)
    {
        $this->service = $service;
    }

    public function buildPuc($empresa_serial) : JsonResponse
    {
        return response()->json(CuentaContable::with('descendants')
            ->where('nivel', '=', AccountConstants::classAccName)->get());
    }

    public function createAccount(CuentaContableRequest $request) : JsonResponse
    {
        return $this->service->createAccount($request->validated());
    }
}
