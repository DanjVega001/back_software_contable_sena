<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Services\UserService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;

class UserController extends Controller
{

    use RefreshDatabase;

    protected $service;

    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    public function createInstructor(CreateUserRequest $request)
    {
        $dataCreateUser = $request->validated();
        return $this->service->createInstructor($dataCreateUser);
    }


}
