<?php

namespace App\Modules\Accounting\Repositories;

use App\Modules\Accounting\Models\CuentaContable;

class CuentaContableRepository
{
    public function createAccount(array $accountData)
    {
        $account = new CuentaContable($accountData);
        $account->save();
    }
}
