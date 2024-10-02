<?php

namespace App\Modules\Settings\Third\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Settings\Third\Http\Requests\ContactoRequest;
use App\Modules\Settings\Third\Http\Requests\DatosFacturacionRequest;
use App\Modules\Settings\Third\Http\Requests\TerceroRequest;
use App\Modules\Settings\Third\Services\TerceroService;
use App\Modules\Shared\Http\Requests\DatosBasicosRequest;
use Illuminate\Http\JsonResponse;

class TerceroController extends Controller
{

    private $service;

    public function __construct(TerceroService $service)
    {
        $this->service = $service;
    }

    public function createThird(DatosBasicosRequest $datosBasicosRequest, TerceroRequest $terceroRequest,
        DatosFacturacionRequest $datosFacturacionRequest, ContactoRequest $contactoRequest) : JsonResponse
    {

        $datosBasicos = $datosBasicosRequest->validated();
        $tercero = $terceroRequest->validated();
        $datosFacturacion = $datosFacturacionRequest->validated();
        $contacto = $contactoRequest->validated();

        return $this->service->createThird($tercero['empresa_serial'], [
            'datos_basicos' => $datosBasicos['datos_basicos'],
            'tercero' => $tercero['datos_terceros'],
            'datos_facturacion' => $datosFacturacion['datos_facturacion'],
            'contacto' => $contacto['datos_contactos'],
        ]);
    }

    public function updateThird(int $tercero_id, DatosBasicosRequest $datosBasicosRequest, TerceroRequest $terceroRequest,
        DatosFacturacionRequest $datosFacturacionRequest, ContactoRequest $contactoRequest) : JsonResponse
    {
        $datosBasicos = $datosBasicosRequest->validated();
        $tercero = $terceroRequest->validated();
        $datosFacturacion = $datosFacturacionRequest->validated();
        $contacto = $contactoRequest->validated();
        return $this->service->updateThird($tercero_id, $tercero['empresa_serial'], [
            'datos_basicos' => $datosBasicos['datos_basicos'],
            'tercero' => $tercero['datos_terceros'],
            'datos_facturacion' => $datosFacturacion['datos_facturacion'],
            'contacto' => $contacto['datos_contactos'],
        ]);
    }

    public function deleteThird(int $tercero_id) : JsonResponse
    {
        $this->service->deleteThird($tercero_id, request("empresa_serial"));
        return response()->json(['message' => 'Tercero eliminado'], 200);
    }

    public function getThird(int $serial, int $tercero_id) : JsonResponse
    {
        $tercero = $this->service->getThird($tercero_id, $serial);
        return response()->json($tercero);
    }

    public function getAllThirds(int $empresa_serial) : JsonResponse
    {
        $terceros = $this->service->getAllThirds($empresa_serial);
        return response()->json($terceros);
    }
}
