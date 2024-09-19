<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Models\User;
use App\Providers\AuthServiceProvider;
use App\Services\UserService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    protected $service;
    protected $empresaRepository;

    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    private function validateInstructor(int $id) : ? User
    {
        return User::where('id', $id)->where('rol_id', AuthServiceProvider::instructor_id)->first();
    }

    private function validateAprendiz(int $id) : ? User
    {
        return User::where('id', $id)->where('rol_id', AuthServiceProvider::aprendiz_id)->first();
    }

    public function createInstructor(CreateUserRequest $request)
    {
        $dataCreateUser = $request->validated();
        return $this->service->createInstructor($dataCreateUser);
    }

    public function getInstructores()
    {
        return response()->json(User::where('rol_id', '=', AuthServiceProvider::instructor_id)->get());
    }

    public function getInstructor(int $instructor_id)
    {
        $user = $this->validateInstructor($instructor_id);
        if (!$user) {
            return response()->json(['errors' => 'Instructor no econtrado']);
        }
        return response()->json($user);
    }

    public function getAprendiz(int $aprendiz_id)
    {   
        $user = $this->validateAprendiz($aprendiz_id);
        if (!$user) {
            return response()->json(['errors' => 'Aprendiz no econtrado']);
        }
        return response()->json($user);
    }

    public function updateInstructor(CreateUserRequest $request, int $instructor_id)
    {
        $dataUpdateUser = $request->validated();
        $user = $this->validateInstructor($instructor_id);
        if (!$user) {
            return response()->json(['errors' => 'Instructor no econtrado']);
        }
        if ($request->get('contrasena') != null) {
            $dataUpdateUser['contrasena'] = Hash::make($request->get('contrasena'));
        }
        $user->update($dataUpdateUser);
        return response()->json([
            'message' => 'El instructor ha sido actualizado correctamente.'
        ], 200);
    }

    public function updateAprendiz(CreateUserRequest $request, int $aprendiz_id)
    {
        $dataUpdateUser = $request->validated();
        $user = $this->validateAprendiz($aprendiz_id);
        if (!$user) {
            return response()->json(['errors' => 'Aprendiz no econtrado']);
        }
        $user->update($dataUpdateUser);
        return response()->json([
           'message' => 'El aprendiz ha sido actualizado correctamente.'
        ], 200);
    }

    public function deleteAprendiz(int $aprendiz_id)
    {
        $user = $this->validateAprendiz($aprendiz_id);
        if (!$user) {
            return response()->json(['errors' => 'Aprendiz no econtrado']);
        }
        $user->delete();
        return response()->json([
           'message' => 'El aprendiz ha sido eliminado correctamente.'
        ], 200);
    }

    public function deleteInstructor(int $instructor_id)
    {
        $user = $this->validateInstructor($instructor_id);
        if (!$user) {
            return response()->json(['errors' => 'Instructor no econtrado']);
        }
        $user->delete();
        return response()->json([
            'message' => 'El instructor ha sido eliminado correctamente.'
        ], 200);
    }

    public function uploadAprendicesFromCSV(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'csvFile' =>'required|file|mimes:csv,txt',
            'numero_ficha' =>'required|numeric'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $file = $request->file('csvFile');
        
        return $this->service->uploadAprendicesFromCSV($file, $request->get('numero_ficha'));
    }
}
