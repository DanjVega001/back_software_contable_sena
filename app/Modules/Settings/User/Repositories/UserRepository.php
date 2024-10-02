<?php

namespace App\Modules\Settings\User\Repositories;

use App\Modules\Shared\Models\User;


class UserRepository
{

    public function getUserByEmail(string $email)
    {
        return User::where('correo_electronico', $email)->first();
    }

    public function createUser(array $data) : User
    {
        $user = new User($data);
        $user->save();
        return $user;
    }

    public function documentOrEmailExists(int $document, string $email) : bool
    {
        return User::where('numero_identificacion', $document)->exists() || User::where('correo_electronico', $email)->exists();
    }
}
