<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $doctorAnaId  = DB::table('usuarios')->where('email', 'ana.doctor@dental.com')->value('id_usuario');
        $doctorLuisId = DB::table('usuarios')->where('email', 'luis.doctor@dental.com')->value('id_usuario');

        $clienteJuanId  = DB::table('clientes')->where('email', 'juan@example.com')->value('id_cliente');
        $clienteLuciaId = DB::table('clientes')->where('email', 'lucia@example.com')->value('id_cliente');

        $sucursalCentral = DB::table('sucursales')->where('nombre', 'Sucursal Central')->value('id_sucursal');
        $sucursalNorte   = DB::table('sucursales')->where('nombre', 'Sucursal el alto')->value('id_sucursal');

        DB::table('citas')->insert([
            [
                'id_cliente'       => $clienteJuanId,
                'id_usuario'       => $doctorAnaId,
                'id_sucursal'      => $sucursalCentral,
                'fecha_hora_inicio'=> now()->addDay()->setTime(9, 0),
                'fecha_hora_fin'   => now()->addDay()->setTime(9, 30),
                'estado'           => 'confirmada',
                'notas'            => 'Control general',
                'created_at'       => now(),
                'updated_at'       => now(),
            ],
            [
                'id_cliente'       => $clienteLuciaId,
                'id_usuario'       => $doctorLuisId,
                'id_sucursal'      => $sucursalNorte,
                'fecha_hora_inicio'=> now()->addDays(2)->setTime(10, 0),
                'fecha_hora_fin'   => now()->addDays(2)->setTime(10, 45),
                'estado'           => 'pendiente',
                'notas'            => 'Ortodoncia',
                'created_at'       => now(),
                'updated_at'       => now(),
            ],
        ]);
    }
}
