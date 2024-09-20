<?php

namespace App\Services;

use App\Http\Requests\DatosEmpresaRequest;
use App\Models\Empresa;
use App\Repositories\DatosBasicosRepository;
use App\Repositories\DatosTributariosRepository;
use App\Repositories\EmpresaRepository;
use App\Repositories\FichaRepository;
use App\Repositories\RepresentanteLegalRepository;
use Exception;
use Facade\FlareClient\Http\Exceptions\NotFound;
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
    protected $fichaRepository;

    public function __construct(
        EmpresaRepository $empresaRepository,
        DatosBasicosRepository $datosBasicosRepository,
        RepresentanteLegalRepository $repLegalRepository,
        DatosTributariosRepository $datosTributariosRepository,
        FichaRepository $fichaRepository
    ) {
        $this->empresaRepository = $empresaRepository;
        $this->datosBasicosRepository = $datosBasicosRepository;
        $this->repLegalRepository = $repLegalRepository;
        $this->datosTributariosRepository = $datosTributariosRepository;
        $this->fichaRepository = $fichaRepository;
    }

    public function createCompany(UploadedFile $reqFile, array $data)
    {
        DB::beginTransaction();

        try {
            
            $serial = $this->generateSerialCompany();
            $data['empresa']['serial'] = $serial;
            $data['empresa']['user_id'] = $data['empresa']['user_id'] ?? Auth::id();
            $logoRuta = $this->saveLogoToStorage($reqFile, $serial);
            $data['empresa']['logo'] = $logoRuta;
            
            $serialEmpresa = $this->empresaRepository->saveCompany($data['empresa']);
            $data['datos_basicos']['empresa_serial'] = $serialEmpresa;
            $this->datosBasicosRepository->saveBasicData($data['datos_basicos']);
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
            dd($th);

            response()->json([
                'errors' => 'Hubo un error al crear la empresa.',
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
                'errors' => 'Hubo un error al editar la empresa.'
            ], 500);
        }
    }

    public function deleteCompany(int $serial)
    {
        DB::beginTransaction();

        try {
            $empresa = Empresa::where('serial', $serial)->first();

            if (!$this->deleteLogoFromStorage($serial)) {
                response()->json([
                    'errors' => 'Hubo un error al eliminar la empresa.'
                ], 500);
            }

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

            return response()->json([
                'errors' => 'Hubo un error al eliminar la empresa.'
            ], 500);
        }
    }

    public function cloneCompany(int $serialEmpresa, int $numeroFicha)
    {

        DB::beginTransaction();
        try {

            $empresa = $this->empresaRepository->getCompanyBySerial($serialEmpresa);
            $ficha = $this->fichaRepository->getFichaByNumero($numeroFicha);
            
            $logo = $this->parseLogoToUploadedFile($empresa->serial, $empresa->logo);
            
            $users = $ficha->users;

            if (count($users) == 0) {
                return response()->json([
                    "errors" => "Ficha no tiene aprendices."
                ], 404);
            }

            foreach ($users as $user) {

                $data = [
                    'datos_basicos' => $empresa->datosBasicos->toArray(),
                    'empresa' => $empresa->toArray(),
                    'datos_tributarios' => $empresa->datosTributarios->toArray(),
                    'representante_legal' => $empresa->representanteLegal->toArray(),
                ];

                $data['empresa']['cobrador_id'] = $user->id;

                $data['datos_tributarios']['responsabilidades_fiscales'] = 
                    array_map(function ($val) {
                        return $val['responsabilidad_fiscal_id'] = $val['codigo'];
                    }, $empresa->datosTributarios->responsabilidadesFiscales->toArray());
                
                $data['empresa']['user_id'] = $user->id;

                $this->createCompany($logo, $data);
            }


            DB::commit();

            return response()->json([
                'message' => 'Empresas clonadas correctamente.',
            ], 201);
        } catch (NotFound $e) {
            DB::rollBack();
            return response()->json([
                'errors' => $e->getMessage(),
            ], 404);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'errors' => $e->getMessage(),
            ], 500);
        } 
    }
    
    private function parseLogoToUploadedFile(int $serial, string $logo) : UploadedFile
    {
        $pathFile = storage_path('app/public'.str_replace('storage/', '', $logo));
        $uploadFile = new UploadedFile(
            $pathFile,
            $serial
        );
        return $uploadFile;
    }

    private function saveLogoToStorage(UploadedFile $reqFile, int $serial): string
    {
        $path = 'public/logos';
        $ruta = $reqFile->storeAs($path, $serial);
        return Storage::url($ruta);
    }

    private function deleteLogoFromStorage(string $serial): bool
    {
        return Storage::delete('public/logos/' . $serial);
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
