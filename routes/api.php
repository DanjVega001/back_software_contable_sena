<?php

use App\Http\Controllers\ActividadEconomicaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CiudadController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\FichaController;
use App\Http\Controllers\RespFiscalController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->group(function () {

    Route::middleware(['role:admin|instructor'])->group(function () {  
        // Crea una nueva empresa
        Route::post("company", [EmpresaController::class, 'createCompany']);
    
    });
    
    Route::middleware(['role:admin'])->group(function () {
        // Crea un nuevo instructor
        Route::post('instructor', [UserController::class, 'createInstructor']);
    });

    Route::middleware(['role:instructor'])->group(function () {
        // Crud de ficha
        Route::apiResource('ficha', FichaController::class);
        // Cargar masiva de aprendices
        Route::post('upload-aprendices', [UserController::class, 'uploadAprendicesFromCSV']);
        
    });

    // Trae al usuario autenticado
    Route::get('user', function () { return auth()->user(); });
    // Trae todas las ciudades
    Route::get('cities', [CiudadController::class, "getCities"]);
    // Trae las responsabilidades fiscales
    Route::get('resp-fiscal', [RespFiscalController::class, "getRespFiscal"]);
    // Trae todas las actividades económicas
    Route::get('actividades-economicas', [ActividadEconomicaController::class, "getActividadesEconomicas"]);
    // Trae las empresas de un usuario
    Route::get('companies', [EmpresaController::class, "getCompanies"]);

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
    });


    

});
