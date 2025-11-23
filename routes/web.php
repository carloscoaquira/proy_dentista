<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthUsuarioWebContorller;
use App\Http\Controllers\HomeController;

Route::get('/login', [AuthUsuarioWebContorller::class, 'showLoginForm'])
    ->name('login');

// procesar login
Route::post('/login', [AuthUsuarioWebContorller::class, 'login'])
    ->name('login.post');

Route::middleware('auth:usuarios')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');

    // cerrar sesión
    Route::post('/logout', [AuthUsuarioWebContorller::class, 'logout'])
        ->name('logout');
});
