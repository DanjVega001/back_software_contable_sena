<?php

namespace App\Http\Controllers;

use App\Http\Requests\DatosBasicosRequest;
use App\Http\Requests\DatosEmpresaRequest;
use App\Http\Requests\DatosTributariosRequest;
use App\Http\Requests\RepesentanteLegalRequest;
use App\Models\Empresa;
use App\Services\EmpresaService;
use Illuminate\Support\Facades\Auth;

class EmpresaController extends Controller
{

    protected $service;

    public function __construct(EmpresaService $service)
    {
        $this->service = $service;
    }

    public function createCompany(DatosBasicosRequest $datosBasicosReq, DatosEmpresaRequest $datosEmpresaReq,
        DatosTributariosRequest $datosTributariosReq, RepesentanteLegalRequest $representanteLegalReq)
    {
        $datosBasicos = $datosBasicosReq->validated();
        $datosEmpresa = $datosEmpresaReq->validated();
        $datosTributarios = $datosTributariosReq->validated();
        $representanteLegal = $representanteLegalReq->validated();

        return $this->service->createCompany([
            'datos_basicos' => $datosBasicos['datos_basicos'],
            'empresa' => $datosEmpresa['datos_empresa'],
            'datos_tributarios' => $datosTributarios['datos_tributarios'],
            'representante_legal' => $representanteLegal['representante_legal'],
        ]);
    }

    public function updateCompany(int $serial, DatosBasicosRequest $datosBasicosReq, DatosEmpresaRequest $datosEmpresaReq,
        DatosTributariosRequest $datosTributariosReq, RepesentanteLegalRequest $representanteLegalReq)
    {
        $exists = Empresa::where([
            'user_id' => Auth::id(),
            'serial' => $serial,
        ])->exists();

        if (!$exists) {
            return response()->json(['error' => 'No se encontró la empresa'], 404);
        }

        $datosBasicos = $datosBasicosReq->validated();
        $datosEmpresa = $datosEmpresaReq->validated();
        $datosTributarios = $datosTributariosReq->validated();
        $representanteLegal = $representanteLegalReq->validated();

        return $this->service->updateCompany($serial, [
            'datos_basicos' => $datosBasicos['datos_basicos'],
            'empresa' => $datosEmpresa['datos_empresa'],
            'datos_tributarios' => $datosTributarios['datos_tributarios'],
            'representante_legal' => $representanteLegal['representante_legal'],
        ]);
    }

}
