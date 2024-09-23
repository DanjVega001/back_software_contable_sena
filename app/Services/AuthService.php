<?php

namespace App\Services;

use App\Providers\AuthServiceProvider;
use App\Repositories\UserRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;

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
                "errors" => "Credenciales incorrectas"
            ], 401);
        }

        Auth::login($user);

        $token = $user->createToken('Personal Access Token');

        return response()->json([
            "access_token" => $token->accessToken,
            "token_type" => "Bearer",
        ]);
    }

    public function logout() : JsonResponse
    {
        $user = Auth::user()->token();
        $user->revoke();
        return response()->json(["message" => "Sesión finalizada"]);
    }
}
