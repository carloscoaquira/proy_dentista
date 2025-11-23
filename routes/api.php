<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\AuthClienteController;
use App\Http\Controllers\Api\CitasController;
use App\Http\Controllers\Api\CatalogoController;

Route::prefix('v1')->group(function(){
    //rutas publicas
    Route::get('catalogo', [CatalogoController::class, 'sucursalesDoctoresHorarios']);

    // AUTH CLIENTES (PÚBLICAS)
    Route::post('clientes/registro', [AuthClienteController::class, 'registrar']);
    Route::post('clientes/login', [AuthClienteController::class, 'login']);

    // RUTAS PROTEGIDAS (CLIENTE LOGUEADO CON TOKEN)
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('cliente/perfil', [AuthClienteController::class, 'perfil']);
        Route::post('logout', [AuthClienteController::class, 'logout']);
        Route::post('citas', [CitasController::class, 'store']);
    });
});
