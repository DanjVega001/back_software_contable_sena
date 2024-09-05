<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\UserController;
use App\Providers\AuthServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        Route::post("company", [EmpresaController::class, 'createCompany']);

        Route::post('aprendiz', [UserController::class, 'createAprendiz']);
    
    });
    
    Route::middleware(['role:admin'])->group(function () {
        Route::post('instructor', [UserController::class, 'createInstructor']);
        Route::post('aprendiz', [UserController::class, 'createAprendiz']);
    });

});
