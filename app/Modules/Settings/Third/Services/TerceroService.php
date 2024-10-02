<?php

namespace App\Modules\Settings\Third\Services;

use App\Modules\Settings\Third\Repositories\ContactoRepository;
use App\Modules\Settings\Third\Repositories\DatosFacturacionRepository;
use App\Modules\Settings\Third\Repositories\TerceroRepository;
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
        DB::beginTransaction();
        try {
            $tercero_id = $this->terceroRepository->saveThird($empresa_serial, $data['tercero']);
            $data['datos_basicos']['tercero_id'] = $tercero_id;
            $data['datos_facturacion']['tercero_id'] = $tercero_id;

            $this->datosBasicosRepository->saveBasicData($data['datos_basicos']);
            $this->datosFacturacionRepository->saveBillingData($data['datos_facturacion']);
            foreach ($data['contacto'] as $contact)
            {
                $contact['tercero_id'] = $tercero_id;
                $this->contactoRepository->saveContact($contact);
            }

            DB::commit();
            return response()->json(['message' => 'Tercero creado exitosamente'], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
