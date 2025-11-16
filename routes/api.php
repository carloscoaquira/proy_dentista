<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\SucursalesController;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\Api\AuthClienteController;

Route::prefix('v1')->group(function(){
    //rutas publicas

    //sucursales
    Route::get('sucursales', [SucursalesController::class, 'index']);
    Route::get('sucursales/{id}', [SucursalesController::class, 'show']);
    // doctores
    Route::get('usuarios', [UsuariosController::class, 'index']);
    Route::get('usuarios/{id}', [UsuariosController::class, 'show']);
    Route::get('usuarios/{id}/horario', [UsuariosController::class, 'horario']);

    // AUTH CLIENTES (PÚBLICAS)
    Route::post('clientes/registro', [AuthClienteController::class, 'registrar']);
    Route::post('clientes/login', [AuthClienteController::class, 'login']);

    // RUTAS PROTEGIDAS (CLIENTE LOGUEADO CON TOKEN)
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('cliente/perfil', [AuthClienteController::class, 'perfil']);
        Route::post('logout', [AuthClienteController::class, 'logout']);

        // 👇 Más adelante aquí irá: POST /citas
        // Route::post('citas', [CitasController::class, 'store']);
    });
});
