<?php

use App\Modules\Accounting\Utils\Constants\AccountConstants;
use App\Modules\Auth\Http\Controllers\AuthController;
use App\Modules\Settings\Company\Http\Controllers\ActividadEconomicaController;
use App\Modules\Settings\Company\Http\Controllers\EmpresaController;
use App\Modules\Settings\User\Http\Controllers\FichaController;
use App\Modules\Settings\User\Http\Controllers\UserController;
use App\Modules\Shared\Http\Controllers\CiudadController;
use App\Modules\Shared\Http\Controllers\RespFiscalController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Modules\Accounting\Http\Controllers\CuentaContableController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('login', [AuthController::class, "login"]);

// Trae todas las ciudades
Route::get('cities', [CiudadController::class, "getCities"]);

Route::middleware('auth:api')->group(function () {

    Route::get('logout', [AuthController::class, "logout"]);

    Route::middleware(['role:admin|instructor'])->group(function () {
        // Crea una nueva empresa
        Route::post("company", [EmpresaController::class, 'createCompany']);

        // Crud de ficha
        Route::apiResource('ficha', FichaController::class);

        // Trae un aprendiz
        Route::get('aprendiz/{aprendiz_id}', [UserController::class, 'getAprendiz']);
        // Actualiza un aprendiz
        Route::put('update-aprendiz/{aprendiz_id}', [UserController::class, "updateAprendiz"]);
        // Elimina un aprendiz
        Route::delete('delete-aprendiz/{aprendiz_id}', [UserController::class, "deleteAprendiz"]);
        // Cargar masiva de aprendices
        Route::post('upload-aprendices', [UserController::class, 'uploadAprendicesFromCSV']);


    });

    Route::middleware(['role:admin'])->group(function () {
        // Crea un nuevo instructor
        Route::post('instructor', [UserController::class, 'createInstructor']);
        // Trae todos los instructores
        Route::get('instructores', [UserController::class, 'getInstructores']);
        // Trae un instructor
        Route::get('instructor/{instructor_id}', [UserController::class, 'getInstructor']);
        // Actualiza un instructor
        Route::put('update-instructor/{instructor_id}', [UserController::class, "updateInstructor"]);
        // Elimina un instructor
        Route::delete('delete-instructor/{instructor_id}', [UserController::class, "deleteInstructor"]);
    });

    // Trae al usuario autenticado
    Route::get('user', function () {
        return auth()->user();
    });

    // Trae las responsabilidades fiscales
    Route::get('resp-fiscal', [RespFiscalController::class, "getRespFiscal"]);
    // Trae todas las actividades económicas
    Route::get('actividades-economicas', [ActividadEconomicaController::class, "getActividadesEconomicas"]);
    // Trae las empresas de un usuario
    Route::get('companies', [EmpresaController::class, "getCompanies"]);
    // Trae todos los tributos
    Route::get('tributos', [\App\Modules\Settings\Company\Http\Controllers\TributoController::class, "getTributos"]);

    // Crud Empresa
    Route::middleware(['onlyMyCompany'])->group(function () {

        // Actualiza una empresa
        Route::put('update-company/{serial}', [EmpresaController::class, "updateCompany"]);

        // Trae todos los datos de una empresa segun el serial
        Route::get('company/{serial}', [EmpresaController::class, "getCompany"]);

        // Elimina una empresa
        Route::delete('delete-company/{serial}', [EmpresaController::class, "deleteCompany"]);

        // Clonar la empresa en los aprendices
        Route::post('clone-company', [EmpresaController::class, 'cloneCompany']);

        // Crear un tercero en mi empresa
        Route::post('create-third', [\App\Modules\Settings\Third\Http\Controllers\TerceroController::class, "createThird"])
            ->name("create.third");

        Route::put('update-third/{tercero_id}', [\App\Modules\Settings\Third\Http\Controllers\TerceroController::class, "updateThird"]);

        Route::delete('delete-third/{tercero_id}', [\App\Modules\Settings\Third\Http\Controllers\TerceroController::class, "deleteThird"]);

        // Trae todos los terceros de mi empresa
        Route::get('thirds/{serial}', [\App\Modules\Settings\Third\Http\Controllers\TerceroController::class, "getAllThirds"]);

        // Trae un tercero de mi empresa
        Route::get('third/{serial}/{tercero_id}', [\App\Modules\Settings\Third\Http\Controllers\TerceroController::class, "getThird"]);

        // Construye el PUC
        Route::get('puc/{empresa_serial}', [CuentaContableController::class, 'buildPuc']);

        // Crea una cuenta contable
        Route::post('create-account', [\App\Modules\Accounting\Http\Controllers\CuentaContableController::class, "createAccount"]);

    });
});
