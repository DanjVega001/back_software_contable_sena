<?php

namespace App\Http\Controllers;

use App\Http\Requests\DatosBasicosRequest;
use App\Http\Requests\DatosEmpresaRequest;
use App\Http\Requests\DatosTributariosRequest;
use App\Http\Requests\RepesentanteLegalRequest;
use App\Models\Empresa;
use App\Services\EmpresaService;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;

class EmpresaController extends Controller
{

    protected $service;

    public function __construct(EmpresaService $service)
    {
        $this->service = $service;
    }

    public function createCompany(
        DatosBasicosRequest $datosBasicosReq,
        DatosEmpresaRequest $datosEmpresaReq,
        DatosTributariosRequest $datosTributariosReq,
        RepesentanteLegalRequest $representanteLegalReq
    ) {
        $datosBasicos = $datosBasicosReq->validated();
        $datosEmpresa = $datosEmpresaReq->validated();
        $datosTributarios = $datosTributariosReq->validated();
        $representanteLegal = $representanteLegalReq->validated();


        return $this->service->createCompany($datosEmpresaReq->file("datos_empresa.logo"), [
            'datos_basicos' => $datosBasicos['datos_basicos'],
            'empresa' => $datosEmpresa['datos_empresa'],
            'datos_tributarios' => $datosTributarios['datos_tributarios'],
            'representante_legal' => $representanteLegal['representante_legal'],
        ]);
    }

    public function updateCompany(
        int $serial,
        DatosBasicosRequest $datosBasicosReq,
        DatosEmpresaRequest $datosEmpresaReq,
        DatosTributariosRequest $datosTributariosReq,
        RepesentanteLegalRequest $representanteLegalReq
    ) {

        $datosBasicos = $datosBasicosReq->validated();
        $datosEmpresa = $datosEmpresaReq->validated();
        $datosTributarios = $datosTributariosReq->validated();
        $representanteLegal = $representanteLegalReq->validated();

        return $this->service->updateCompany($datosEmpresaReq->file('datos_empresa.logo'),$serial, [
            'datos_basicos' => $datosBasicos['datos_basicos'],
            'empresa' => $datosEmpresa['datos_empresa'],
            'datos_tributarios' => $datosTributarios['datos_tributarios'],
            'representante_legal' => $representanteLegal['representante_legal'],
        ]);
    }

    public function getCompanies()
    {
        return response()->json(Empresa::with('datosBasicos')
            ->where('user_id', '=', Auth::id())->get());
    }

    public function getCompany(int $serial)
    {
        return response()->json(Empresa::with([
            'datosBasicos',
            'representanteLegal',
            'datosTributarios',
            'datosTributarios.responsabilidadesFiscales'
        ])
            ->where([
                'user_id' => Auth::id(),
                'serial' => $serial,
            ])->firstOrFail());
    }

    public function deleteCompany(int $serial)
    {
        return $this->service->deleteCompany($serial);
    }
}
