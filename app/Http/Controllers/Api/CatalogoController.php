<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\sucursales;

class CatalogoController extends Controller
{
    /**
     * Devolver estructura:
     * sucursales -> doctores -> horarios -> rangos -> especialidades
     */
    public function sucursalesDoctoresHorarios()
    {
        // Eager loading de toda la cadena
        $sucursales = sucursales::with([
            'usuarios' => function ($q) {
                // solo doctores
                $q->whereHas('rol', function ($sub) {
                    $sub->where('nombre', 'doctor');
                });
            },
            'usuarios.especialidades',
            'usuarios.horarios.rangos',
        ])
        ->where('estado', true) // si tienes un campo estado en sucursales
        ->get();

        // Opcional: transformar para no mandar todos los campos crudos de la BD
        $data = $sucursales->map(function ($sucursal) {
            return [
                'id_sucursal' => $sucursal->id_sucursal,
                'nombre'      => $sucursal->nombre,
                'direccion'   => $sucursal->direccion,
                'ciudad'      => $sucursal->ciudad,
                'telefono'    => $sucursal->telefono,
                'doctores'    => $sucursal->usuarios->map(function ($doctor) {
                    return [
                        'id_usuario'     => $doctor->id_usuario,
                        'nombre'         => $doctor->nombre,
                        'apellido'       => $doctor->apellido,
                        'email'          => $doctor->email,
                        'telefono'       => $doctor->telefono,
                        'especialidades' => $doctor->especialidades->map(function ($esp) {
                            return [
                                'id_especialidad' => $esp->id_especialidad,
                                'nombre'          => $esp->nombre,
                            ];
                        })->values(),
                        'horarios'       => $doctor->horarios->map(function ($horario) {
                            return [
                                'id_horario' => $horario->id_horario,
                                'dia_semana' => $horario->dia_semana,
                                'activo'     => $horario->activo,
                                'rangos'     => $horario->rangos->map(function ($rango) {
                                    return [
                                        'id_rango_horario' => $rango->id_rango_horario,
                                        'hora_inicio'      => $rango->hora_inicio,
                                        'hora_fin'         => $rango->hora_fin,
                                    ];
                                })->values(),
                            ];
                        })->values(),
                    ];
                })->values(),
            ];
        })->values();

        return response()->json($data);
    }
}

