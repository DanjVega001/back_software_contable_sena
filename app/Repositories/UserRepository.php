<?php

namespace App\Repositories;

use App\Models\User;


class UserRepository
{

    public function getUserByEmail(string $email)
    {
        return User::where('correo_electronico', $email)->first();
    }
}
