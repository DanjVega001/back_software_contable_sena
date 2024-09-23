<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Services\AuthService;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;


class AuthController extends Controller
{

    private $service;

    public function __construct(AuthService $service)
    {
        $this->service = $service;
    }

    public function login(LoginRequest $request): JsonResponse
    {
        $data = $request->validated();
        return $this->service->login($data);
    }

    public function logout() : JsonResponse
    {
        return $this->service->logout();
    }


}
