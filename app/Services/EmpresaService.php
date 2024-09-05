<?php

namespace App\Services;

use App\Repositories\EmpresaRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class EmpresaService
{

    protected $repository;

    public function __construct(EmpresaRepository $repository)
    {
        $this->repository = $repository;
    }

    public function createCompany(array $data)
    {
        DB::beginTransaction();

        try {
            $idDatosBasicos = $this->repository->saveBasicData($data['datos_basicos']);
            $data['empresa']['datos_basicos_id'] = $idDatosBasicos;
            $data['empresa']['serial'] = $this->generateSerialCompany();
            $data['empresa']['user_id'] = $data['empresa']['user_id'] ?? Auth::id();

            $serialEmpresa = $this->repository->saveCompany($data['empresa']);
            $data['datos_tributarios']['empresa_serial'] = $serialEmpresa;
            $this->repository->saveTributaryData($data['datos_tributarios']);

            $data['representante_legal']['empresa_serial'] = $serialEmpresa;
            $this->repository->saveLegalRepresentative($data['representante_legal']);

            DB::commit();

            return response()->json([
               'message' => 'La empresa ha sido creada correctamente.'
            ], 201);
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th->getMessage());

            response()->json([
                'error' => 'Hubo un error al crear la empresa.'
            ], 500);
        }
    }

    private function generateSerialCompany(): int
    {
        $serial = 0;
        while (true) {
            $serial = random_int(8, 14);
            if ($this->repository->serialExists($serial)) continue;
            else break;
        }
        return $serial;
    }
}
