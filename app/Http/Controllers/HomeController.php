<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $usuario = Auth::guard('usuarios')->user();
        // si quieres: $usuario->load('rol', 'sucursal');

        // Vista: resources/views/home.blade.php
        return view('home', compact('usuario'));
    }
}
