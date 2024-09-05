<?php

namespace App\Services;

use App\Providers\AuthServiceProvider;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;

class UserService
{

    protected $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function createInstructor(array $data)
    {
        $data['contrasena'] = Hash::make($data['numero_identificacion']);
        $data['rol_id'] = AuthServiceProvider::instructor_id;
        $user = $this->repository->createUser($data);
        if (!isset($user)) {
            return response()->json([
                'message' => 'Hubo un error al crear el instructor.'
            ], 500);
        }
        
        return response()->json([
            'message' => 'El instructor ha sido creado correctamente.'
        ], 201);
    }

    public function createAprendiz(array $data)
    {
        $data['contrasena'] = Hash::make($data['numero_identificacion']);
        $data['rol_id'] = AuthServiceProvider::aprendiz_id;
        $user = $this->repository->createUser($data);
        if (!isset($user)) {
            return response()->json([
                'message' => 'Hubo un error al crear el aprendiz.'
            ], 500);
        }
        
        return response()->json([
            'message' => 'El aprendiz ha sido creado correctamente.'
        ], 201);
    }

   

}
