<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsuarioEspecialidadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $doctorAnaId  = DB::table('usuarios')->where('email', 'ana.doctor@dental.com')->value('id_usuario');
        $doctorLuisId = DB::table('usuarios')->where('email', 'luis.doctor@dental.com')->value('id_usuario');

        $idGeneral    = DB::table('especialidades')->where('nombre', 'Odontología general')->value('id_especialidad');
        $idEndodoncia = DB::table('especialidades')->where('nombre', 'Endodoncia')->value('id_especialidad');
        $idOrtodoncia = DB::table('especialidades')->where('nombre', 'Ortodoncia')->value('id_especialidad');

        DB::table('usuario_especialidad')->insert([
            // Ana: general + endodoncia
            [
                'id_usuario'     => $doctorAnaId,
                'id_especialidad'=> $idGeneral,
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            [
                'id_usuario'     => $doctorAnaId,
                'id_especialidad'=> $idEndodoncia,
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            // Luis: general + ortodoncia
            [
                'id_usuario'     => $doctorLuisId,
                'id_especialidad'=> $idGeneral,
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            [
                'id_usuario'     => $doctorLuisId,
                'id_especialidad'=> $idOrtodoncia,
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
        ]);
    }
}
