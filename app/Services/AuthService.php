<?php

namespace App\Services;

use App\Providers\AuthServiceProvider;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthService
{

    protected $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }


    public function login(array $data)
    {
        $user = $this->repository->getUserByEmail($data['correo_electronico']);

        if (!$user || !Hash::check($data['contrasena'], $user->contrasena)) {
            return response()->json([
                "message" => "Credenciales incorrectas"
            ], 401);
        }

        Auth::login($user);

        $token = $user->createToken('Personal Access Token');

        return response()->json([
            "access_token" => $token->accessToken,
            "token_type" => "Bearer",
        ]);
    }
}
