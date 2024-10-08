<?php

namespace App\Modules\Settings\Company\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Settings\Company\Http\Requests\DatosEmpresaRequest;
use App\Modules\Settings\Company\Http\Requests\DatosTributariosRequest;
use App\Modules\Settings\Company\Http\Requests\RepesentanteLegalRequest;
use App\Modules\Settings\Company\Models\Empresa;
use App\Modules\Settings\Company\Services\EmpresaService;
use App\Modules\Shared\Http\Requests\DatosBasicosRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class EmpresaController extends Controller
{

    protected $service;

    public function __construct(EmpresaService $service)
    {
        $this->service = $service;
    }

    public function createCompany(
        DatosEmpresaRequest $datosEmpresaReq,
        DatosBasicosRequest $datosBasicosReq,
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
        DatosEmpresaRequest $datosEmpresaReq,
        DatosBasicosRequest $datosBasicosReq,
        DatosTributariosRequest $datosTributariosReq,
        RepesentanteLegalRequest $representanteLegalReq
    ) {
        $datosBasicos = \request()->all();
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
            'datosTributarios.responsabilidadesFiscales',
            'datosTributarios.tributos'
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

    public function cloneCompany(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'empresa_serial' => 'required|exists:empresas,serial|numeric',
            'numero_ficha' => 'required|exists:fichas,numero|numeric',
        ]);

        if ($validated->fails()) {
            return response()->json([
                'errors' => $validated->errors()
            ], 422);
        }

        return $this->service->cloneCompany($request->get('empresa_serial'), $request->get('numero_ficha'));
    }
}
