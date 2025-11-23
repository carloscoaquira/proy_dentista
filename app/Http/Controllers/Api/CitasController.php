<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\citas;

class CitasController extends Controller
{
    public function store(Request $request)
    {
        // Cliente autenticado (proviene de la tabla clientes)
        $cliente = $request->user();

        // Validación de los datos enviados
        $validator = Validator::make($request->all(), [
            'id_usuario'        => 'required|exists:usuarios,id_usuario',
            'id_sucursal'       => 'required|exists:sucursales,id_sucursal',
            'fecha_hora_inicio' => 'required|date_format:Y-m-d H:i:s|after:now',
            'fecha_hora_fin'    => 'required|date_format:Y-m-d H:i:s|after:fecha_hora_inicio',
            'notas'             => 'nullable|string',
        ]);

        // Si falla la validación
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Errores de validación',
                'errors'  => $validator->errors(),
            ], 422);
        }

        $data = $validator->validated();

        // TODO: validar disponibilidad del doctor más adelante
        // TODO: validar que no haya citas superpuestas

        // Crear la cita
        $cita = citas::create([
            'id_cliente'        => $cliente->id_cliente,
            'id_usuario'        => $data['id_usuario'],
            'id_sucursal'       => $data['id_sucursal'],
            'fecha_hora_inicio' => $data['fecha_hora_inicio'],
            'fecha_hora_fin'    => $data['fecha_hora_fin'],
            'estado'            => 'pendiente',
            'notas'             => $data['notas'] ?? null,
        ]);

        return response()->json([
            'message' => 'Cita creada correctamente',
            'cita'    => $cita,
        ], 201);
    }
}
