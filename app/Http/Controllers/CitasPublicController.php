<?php

namespace App\Http\Controllers;

use App\Models\clientes;
use App\Models\citas;
use App\Models\usuarios;
use App\Models\sucursales;
use App\Models\roles;
use Illuminate\Http\Request;

class CitasPublicController extends Controller
{
    public function store(Request $request)
    {
        // 1) Validación básica
        $data = $request->validate([
            'nombre'            => ['required', 'string', 'max:120'],
            'apellido'          => ['required', 'string', 'max:120'],
            'nro_documento'     => ['nullable', 'string', 'max:50'],
            'email'            => ['nullable', 'email', 'max:150'],
            'telefono'          => ['nullable', 'string', 'max:32'],
            'id_sucursal'       => ['required', 'exists:sucursales,id_sucursal'],
            'id_usuario'        => ['required', 'exists:usuarios,id_usuario'],
            'fecha_hora_inicio' => ['required', 'date_format:Y-m-d H:i:s', 'after:now'],
            'fecha_hora_fin'    => ['required', 'date_format:Y-m-d H:i:s', 'after:fecha_hora_inicio'],
            'notas'             => ['nullable', 'string'],
        ]);

        // 2) Validar que el usuario sea doctor y esté activo
        $idRolDoctor = roles::where('nombre', 'doctor')->value('id_rol');

        $doctor = usuarios::where('id_usuario', $data['id_usuario'])
            ->where('id_rol', $idRolDoctor)
            ->where('estado', true)
            ->first();

        if (!$doctor) {
            return response()->json([
                'message' => 'El doctor seleccionado no es válido o no está activo.',
            ], 422);
        }

        // 3) Buscar o crear cliente (por nro_documento o correo)
        $clienteQuery = clientes::query();

        if (!empty($data['nro_documento'])) {
            $clienteQuery->orWhere('nro_documento', $data['nro_documento']);
        }

        if (!empty($data['email'])) {
            $clienteQuery->orWhere('email', $data['email']);
        }

        $cliente = $clienteQuery->first();

        if (!$cliente) {
            $cliente = clientes::create([
                'nombre'        => $data['nombre'],
                'apellido'      => $data['apellido'],
                'nro_documento' => $data['nro_documento'] ?? null,
                'email'        => $data['email'] ?? null,
                'telefono'      => $data['telefono'] ?? null,
            ]);
        }

        // 4) Validar que el doctor no tenga otra cita en ese rango (choque de horarios simple)
        $inicio = $data['fecha_hora_inicio'];
        $fin    = $data['fecha_hora_fin'];

        $existeChoque = citas::where('id_usuario', $doctor->id_usuario)
            ->where(function ($q) use ($inicio, $fin) {
                $q->whereBetween('fecha_hora_inicio', [$inicio, $fin])
                  ->orWhereBetween('fecha_hora_fin', [$inicio, $fin])
                  ->orWhere(function ($q2) use ($inicio, $fin) {
                      $q2->where('fecha_hora_inicio', '<=', $inicio)
                         ->where('fecha_hora_fin', '>=', $fin);
                  });
            })
            ->exists();

        if ($existeChoque) {
            return response()->json([
                'message' => 'El doctor ya tiene una cita en ese horario.',
            ], 422);
        }

        // 5) Crear la cita en estado "pendiente" (o el que estés usando)
        $cita = citas::create([
            'id_cliente'        => $cliente->id_cliente,
            'id_usuario'        => $doctor->id_usuario,
            'id_sucursal'       => $data['id_sucursal'],
            'fecha_hora_inicio' => $inicio,
            'fecha_hora_fin'    => $fin,
            'estado'            => 'pendiente', // o el valor que uses
            'notas'             => $data['notas'] ?? null,
        ]);

        return response()->json([
            'message' => 'Cita creada correctamente.',
            'cita'    => $cita,
            'cliente' => $cliente,
        ], 201);
    }
}
