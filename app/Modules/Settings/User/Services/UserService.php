<?php

namespace App\Modules\Settings\User\Services;

use App\Modules\Settings\User\Repositories\FichaRepository;
use App\Modules\Settings\User\Repositories\UserRepository;
use App\Modules\Shared\Models\User;
use App\Providers\AuthServiceProvider;
use Exception;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use InvalidArgumentException;
use PhpOffice\PhpSpreadsheet\Reader\Csv;

class UserService
{

    protected $repository;
    protected $fichaRepository;

    public function __construct(UserRepository $repository, FichaRepository $fichaRepository)
    {
        $this->repository = $repository;
        $this->fichaRepository = $fichaRepository;
    }

    public function createInstructor(array $data)
    {
        $data['contrasena'] = Hash::make($data['numero_identificacion']);
        $data['rol_id'] = AuthServiceProvider::instructor_id;
        $user = $this->repository->createUser($data);
        if (!isset($user)) {
            return response()->json([
                'errors' => 'Hubo un error al crear el instructor.'
            ], 500);
        }

        return response()->json([
            'message' => 'El instructor ha sido creado correctamente.'
        ], 201);
    }

    public function createAprendiz(array $data) :User
    {
        $data['contrasena'] = Hash::make($data['numero_identificacion']);
        $data['rol_id'] = AuthServiceProvider::aprendiz_id;
        $user = $this->repository->createUser($data);
        if (!isset($user)) {
            throw new Exception("Error al crear el aprendiz:" . $data['correo_electronico']);
        }
        return $user;
    }

    public function uploadAprendicesFromCSV(UploadedFile $file, int $numero_ficha)
    {
        DB::beginTransaction();
        try {
            $reader = new Csv();
            $spreadsheet = $reader->load($file);
            $sheetData = $spreadsheet->getActiveSheet()->toArray();

            $fields = $sheetData[0];

            $aprendices = [];
            $aprendicesRepetidos = [];

            for ($i=1; $i < count($sheetData); $i++) {
                $aprendizCsv = $sheetData[$i];
                $data = array_combine($fields, $aprendizCsv);
                if ($this->repository->documentOrEmailExists($data['numero_identificacion'], $data['correo_electronico'])) {
                    $aprendicesRepetidos[] = [
                        'numero_identificacion' => $data['numero_identificacion'],
                        'nombres' => $data['nombres'] . ' ' . $data['apellidos'],
                    ];
                    continue;
                }
                $aprendiz = $this->createAprendiz($data);
                if ($aprendiz === null) {
                    throw new Exception("Error en la carga del aprendiz de la fila " . $i);
                }
                $aprendices[] = [
                    'user_id' => $aprendiz->id,
                    'rol' => 'aprendiz'
                ];
            }

            $ficha = $this->fichaRepository->getFichaByNumero($numero_ficha);
            $ficha->users()->attach($aprendices);

            DB::commit();
            return response()->json([
                'message' => 'Carga realizada correctamente',
                'repeated' => $aprendicesRepetidos
            ]);
        } catch (InvalidArgumentException $e) {
            DB::rollBack();
            return response()->json([
                'error' => $e->getMessage(),
            ], 422);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'error' => 'Hubo un error al cargar los aprendices.',
                'message' => $e->getMessage(),
            ], 500);
        }



    }

}
