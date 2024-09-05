<?php

namespace App\Http\Controllers;

use App\Http\Requests\DatosBasicosRequest;
use App\Http\Requests\DatosEmpresaRequest;
use App\Http\Requests\DatosTributariosRequest;
use App\Http\Requests\RepesentanteLegalRequest;
use App\Services\EmpresaService;

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

}
