<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Services\UserService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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

    public function uploadAprendicesFromCSV(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'csvFile' =>'required|file|mimes:csv,txt'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $file = $request->file('csvFile');
        
        return $this->service->uploadAprendicesFromCSV($file);
    }


}
