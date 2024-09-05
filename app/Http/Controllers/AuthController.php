<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Services\AuthService;
use Illuminate\Foundation\Http\FormRequest;


class AuthController extends Controller
{
    
    private $service;

    public function __construct(AuthService $service)
    {
        $this->service = $service;
    }

    public function login(LoginRequest $request)
    {
        $data = $request->validated();
        return $this->service->login($data);
    }

    
}
