<?php

namespace App\Services;

use App\Http\Requests\DatosEmpresaRequest;
use App\Models\Empresa;
use App\Repositories\DatosBasicosRepository;
use App\Repositories\DatosTributariosRepository;
use App\Repositories\EmpresaRepository;
use App\Repositories\RepresentanteLegalRepository;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class EmpresaService
{

    protected $empresaRepository;
    protected $datosBasicosRepository;
    protected $repLegalRepository;
    protected $datosTributariosRepository;

    public function __construct(
        EmpresaRepository $empresaRepository,
        DatosBasicosRepository $datosBasicosRepository,
        RepresentanteLegalRepository $repLegalRepository,
        DatosTributariosRepository $datosTributariosRepository
    ) {
        $this->empresaRepository = $empresaRepository;
        $this->datosBasicosRepository = $datosBasicosRepository;
        $this->repLegalRepository = $repLegalRepository;
        $this->datosTributariosRepository = $datosTributariosRepository;
    }

    public function createCompany(UploadedFile $reqFile, array $data)
    {
        DB::beginTransaction();

        try {
            $idDatosBasicos = $this->datosBasicosRepository->saveBasicData($data['datos_basicos']);
            $data['empresa']['datos_basicos_id'] = $idDatosBasicos;
            $serial = $this->generateSerialCompany();
            $data['empresa']['serial'] = $serial;
            $data['empresa']['user_id'] = $data['empresa']['user_id'] ?? Auth::id();
            $logoRuta = $this->saveLogoToStorage($reqFile, $serial);
            $data['empresa']['logo'] = $logoRuta;

            $serialEmpresa = $this->empresaRepository->saveCompany($data['empresa']);
            $data['datos_tributarios']['empresa_serial'] = $serialEmpresa;
            $this->datosTributariosRepository->saveTributaryData($data['datos_tributarios']);

            $data['representante_legal']['empresa_serial'] = $serialEmpresa;
            $this->repLegalRepository->saveLegalRepresentative($data['representante_legal']);

            DB::commit();

            return response()->json([
                'message' => 'La empresa ha sido creada correctamente.',
                'serial' => $data['empresa']['serial']
            ], 201);
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th->getMessage());

            response()->json([
                'error' => 'Hubo un error al crear la empresa.'
            ], 500);
        }
    }

    public function updateCompany(UploadedFile $reqFile, int $serial, array $data)
    {
        DB::beginTransaction();

        try {

            $empresa = Empresa::where('serial', $serial)->first();

            $data['empresa']['logo'] = $this->saveLogoToStorage($reqFile, $serial);
            
            $this->datosBasicosRepository->updateBasicData($empresa->datosBasicos, $data['datos_basicos']);
            $this->empresaRepository->updateCompany($empresa, $data['empresa']);
            $this->datosTributariosRepository->updateTributaryData($empresa->datosTributarios, $data['datos_tributarios']);
            $this->repLegalRepository->updateLegalRepresentative($empresa->representanteLegal, $data['representante_legal']);

            DB::commit();

            return response()->json([
                'message' => 'La empresa ha sido editada correctamente.',
                'serial' => $empresa->serial
            ], 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th->getMessage());

            response()->json([
                'error' => 'Hubo un error al editar la empresa.'
            ], 500);
        }
    }

    public function deleteCompany(int $serial)
    {
        DB::beginTransaction();

        try {
            $empresa = Empresa::where('serial', $serial)->first();

            $this->deleteLogoFromStorage($serial);

            $this->repLegalRepository->deleteLegalRepresentative($empresa->representanteLegal);

            $this->datosTributariosRepository->deleteTributaryData($empresa->datosTributarios);

            $this->empresaRepository->deleteCompany($empresa);

            $this->datosBasicosRepository->deleteBasicData($empresa->datosBasicos);

            DB::commit();

            return response()->json([
                'message' => 'La empresa ha sido eliminada correctamente.',
                'serial' => $serial
            ], 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th->getMessage());

            response()->json([
                'error' => 'Hubo un error al eliminar la empresa.'
            ], 500);
        }
    }

    private function saveLogoToStorage(UploadedFile $reqFile, int $serial): string
    {
        $path = 'public/logos/';
        return $reqFile->storeAs($path, $serial);
    }

    private function deleteLogoFromStorage(string $serial) 
    {
        Storage::delete('public/logos/' . $serial);
    }

    private function generateSerialCompany(): int
    {
        $serial = 0;
        while (true) {
            $serial = random_int(0, 9999999999999);
            if ($this->empresaRepository->serialExists($serial)) continue;
            else break;
        }
        return $serial;
    }
}
