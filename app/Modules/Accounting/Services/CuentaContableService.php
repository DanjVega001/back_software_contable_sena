<?php

namespace App\Modules\Accounting\Services;

use App\Modules\Accounting\Repositories\CuentaContableRepository;
use Illuminate\Http\JsonResponse;

class CuentaContableService
{

    private $cuentaContableRepository;

    public function __construct(CuentaContableRepository $cuentaContableRepository)
    {
        $this->cuentaContableRepository = $cuentaContableRepository;
    }

    public function createAccount(array $account) : JsonResponse
    {
        $this->cuentaContableRepository->createAccount($account);
        return response()->json(['message' => 'Cuenta contable creada exitosamente.'], 201);
    }
}
