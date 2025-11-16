<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\clientes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthClienteController extends Controller
{
    // 📌 Registro de cliente (web)
    public function registrar(Request $request)
    {
        $data = $request->validate([
            'nombre'    => 'required|string|max:120',
            'apellido'  => 'required|string|max:120',
            'email'     => 'required|email|unique:clientes,email',
            'telefono'  => 'nullable|string|max:32',
            'password'  => 'required|string|min:6|confirmed',
            // password_confirmation debe venir en el request
        ]);

        $cliente = clientes::create([
            'nombre'   => $data['nombre'],
            'apellido' => $data['apellido'],
            'email'    => $data['email'],
            'telefono' => $data['telefono'] ?? null,
            'nro_documento' => null, // si quieres podrías permitirlo también
            'password' => Hash::make($data['password']),
        ]);

        $token = $cliente->createToken('cliente-token')->plainTextToken;

        return response()->json([
            'message' => 'Registro exitoso',
            'cliente' => $cliente,
            'token'   => $token,
        ], 201);
    }

    // 🔑 Login de cliente (web)
    public function login(Request $request)
    {
        $data = $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        $cliente = clientes::where('email', $data['email'])->first();

        if (! $cliente || ! Hash::check($data['password'], $cliente->password)) {
            throw ValidationException::withMessages([
                'email' => ['Las credenciales no son válidas.'],
            ]);
        }

        // opcional: eliminar tokens anteriores
        $cliente->tokens()->delete();

        $token = $cliente->createToken('cliente-token')->plainTextToken;

        return response()->json([
            'message' => 'Login exitoso',
            'cliente' => $cliente,
            'token'   => $token,
        ]);
    }

    // 👤 Ver perfil del cliente logueado
    public function perfil(Request $request)
    {
        return response()->json($request->user());
    }

    // 🚪 Cerrar sesión (revocar token actual)
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Sesión cerrada']);
    }
}
