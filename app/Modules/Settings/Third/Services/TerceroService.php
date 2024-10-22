<?php

namespace App\Modules\Settings\Third\Services;

use App\Modules\Settings\Third\Models\Tercero;
use App\Modules\Settings\Third\Repositories\ContactoRepository;
use App\Modules\Settings\Third\Repositories\DatosFacturacionRepository;
use App\Modules\Settings\Third\Repositories\TerceroRepository;
use App\Modules\Shared\Models\DatoBasico;
use App\Modules\Shared\Repositories\DatosBasicosRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class TerceroService
{

    private $datosBasicosRepository;
    private $terceroRepository;
    private $datosFacturacionRepository;
    private $contactoRepository;

    public function __construct(TerceroRepository $terceroRepository, DatosBasicosRepository $datosBasicosRepository,
        DatosFacturacionRepository $datosFacturacionRepository, ContactoRepository $contactoRepository)
    {
        $this->terceroRepository = $terceroRepository;
        $this->datosBasicosRepository = $datosBasicosRepository;
        $this->datosFacturacionRepository = $datosFacturacionRepository;
        $this->contactoRepository = $contactoRepository;
    }

    public function createThird(int $empresa_serial, array $data) : JsonResponse
    {
        try {
            DB::beginTransaction();
            $tercero_id = $this->terceroRepository->saveThird($empresa_serial, $data['tercero']);
            $data['datos_basicos']['tercero_id'] = $tercero_id;
            $data['datos_facturacion']['tercero_id'] = $tercero_id;

            $this->datosBasicosRepository->saveBasicData($data['datos_basicos']);
            $this->datosFacturacionRepository->saveBillingData($data['datos_facturacion']);
            if($data['contacto']){
                foreach ($data['contacto'] as $contact)
                {
                    $contact['tercero_id'] = $tercero_id;
                    $this->contactoRepository->saveContact($contact);
                }
            }

            DB::commit();
            return response()->json(['message' => 'Tercero creado exitosamente'], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function updateThird(int $tercero_id, int  $empresa_serial, array $data) : JsonResponse
    {
        try {
            DB::beginTransaction();
            $tercero = $this->terceroRepository->find($tercero_id, $empresa_serial);

            if (!$tercero) {
                return response()->json(['error' => 'Tercero no encontrado'], 404);
            }

            $this->terceroRepository->updateThird($tercero, $data['tercero']);

            $this->datosBasicosRepository->updateBasicData($this->datosBasicosRepository->findByTercero($tercero_id), $data['datos_basicos']);
            $this->datosFacturacionRepository->updateBillingData($tercero->datosFacturacion, $data['datos_facturacion']);
            if($data['contacto']){
                foreach ($data['contacto'] as $contact)
                {
                    if (isset($contact['id'])) {
                        $contacto = $this->contactoRepository->find($contact['id']);
                        $this->contactoRepository->updateContact($contacto, $contact);
                    } else {
                        $contact['tercero_id'] = $tercero_id;
                        $this->contactoRepository->saveContact($contact);
                    }
                }
            }


            DB::commit();

            return response()->json(['message' => 'Tercero actualizado exitosamente'], 200);
        } catch (\Exception|\Throwable $e) {
            DB::rollBack();
            return response()->json(['error' => 'Error al actualizar tercero'], 500);
        }
    }

    public function deleteThird(int $tercero_id, int $serial) : JsonResponse
    {
        try {
            DB::beginTransaction();
            $tercero = $this->terceroRepository->find($tercero_id, $serial);
            if (!$tercero) {
                return response()->json(['error' => 'Tercero no encontrado'], 404);
            }

            $this->terceroRepository->deleteThird($tercero);

            DB::commit();
            return response()->json(['message' => 'Tercero eliminado exitosamente'], 200);
        } catch (\Exception|\Throwable $e) {
            DB::rollBack();
            return response()->json(['error' => 'Error al eliminar tercero'], 500);
        }
    }

    public function getThird(int $tercero_id, int $empresa_serial)
    {
        $tercero = $this->terceroRepository->find($tercero_id, $empresa_serial);
        if (!$tercero) {
            return response()->json(['error' => 'Tercero no encontrado'], 404);
        }
        return $tercero;
    }

    public function getAllThirds(int $empresa_serial)
    {
        return $this->terceroRepository->getAllThirds($empresa_serial);
    }
}
