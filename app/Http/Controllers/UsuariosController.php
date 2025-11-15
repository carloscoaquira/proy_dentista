<?php

namespace App\Http\Controllers;

use App\Models\usuarios;
use App\Models\roles;
use App\Models\horarios;
use Illuminate\Http\Request;

class UsuariosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $idRolDoctor = roles::where('nombre', 'doctor')->value('id_rol');
        $doctores = usuarios::where('id_rol', $idRolDoctor)
            ->where('estado', true)
            ->get();
        return response()->json($doctores);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $idRolDoctor = roles::where('nombre', 'doctor')->value('id_rol');
        $doctor = usuarios::with(['sucursal'])
            ->where('id_rol', $idRolDoctor)
            ->where('estado', true)
            ->where('id_usuario', $id)
            ->firstOrFail();

        return response()->json($doctor);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(usuarios $usuarios)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, usuarios $usuarios)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(usuarios $usuarios)
    {
        //
    }
    /**
     * Devuelve el horario de un doctor (día + rangos).
    */
    public function horario($id)
    {
        $idRolDoctor = roles::where('nombre', 'doctor')->value('id_rol');

        // Validamos que el usuario exista y sea doctor activo
        $doctor = usuarios::where('id_rol', $idRolDoctor)
            ->where('estado', true)
            ->where('id_usuario', $id)
            ->firstOrFail();

        // Traemos sus horarios activos con sus rangos
        $horarios = horarios::where('id_doctor', $doctor->id_usuario)
            ->where('activo', true)
            ->with('rangos')
            ->get();

        return response()->json([
            'doctor'   => [
                'id'       => $doctor->id_usuario,
                'nombre'   => $doctor->nombre,
                'apellido' => $doctor->apellido,
            ],
            'horarios' => $horarios,
        ]);
    }

}
