<?php

namespace App\Services;

use App\Providers\AuthServiceProvider;
use App\Repositories\UserRepository;
use Exception;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use InvalidArgumentException;
use PhpOffice\PhpSpreadsheet\Reader\Csv;

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

    public function createAprendiz(array $data) :bool
    {
        if ($this->repository->getUserByEmail($data['correo_electronico']) != null) {
            throw new InvalidArgumentException("Email ya registrado: " . $data['correo_electronico']);
        }
        $data['contrasena'] = Hash::make($data['numero_identificacion']);
        $data['rol_id'] = AuthServiceProvider::aprendiz_id;
        $user = $this->repository->createUser($data);
        if (!isset($user)) {
            return false;
        }
        
        return true;
    }

    public function uploadAprendicesFromCSV(UploadedFile $file)
    {
        try {
            $reader = new Csv();
            $spreadsheet = $reader->load($file);
            $sheetData = $spreadsheet->getActiveSheet()->toArray();

            $fields = $sheetData[0];

            for ($i=1; $i < count($sheetData); $i++) { 
                $aprendizCsv = $sheetData[$i];
                if (!$this->createAprendiz(array_combine($fields, $aprendizCsv))) {
                    throw new Exception("Error en la carga del aprendiz de la fila " . $i);
                } 
            }

            return response()->json([
                'message' => 'Carga realizada correctamente',
            ]);
        } catch (InvalidArgumentException $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Hubo un error al cargar los aprendices.',
            ], 500);
        } 


        
    }

}
