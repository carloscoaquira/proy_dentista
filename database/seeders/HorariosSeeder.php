<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HorariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $doctorAnaId  = DB::table('usuarios')->where('email', 'ana.doctor@dental.com')->value('id_usuario');
        $doctorLuisId = DB::table('usuarios')->where('email', 'luis.doctor@dental.com')->value('id_usuario');

        // Días 1-5 (lunes a viernes)
        foreach ([$doctorAnaId, $doctorLuisId] as $idDoctor) {
            for ($dia = 1; $dia <= 5; $dia++) {
                $idHorario = DB::table('horarios')->insertGetId([
                    'id_doctor'   => $idDoctor,
                    'dia_semana'  => $dia,
                    'activo'      => true,
                    'created_at'  => now(),
                    'updated_at'  => now(),
                ]);

                // Mañana 09:00–12:00
                DB::table('rango_horarios')->insert([
                    'id_horario'  => $idHorario,
                    'hora_inicio' => '09:00:00',
                    'hora_fin'    => '12:00:00',
                    'created_at'  => now(),
                    'updated_at'  => now(),
                ]);

                // Tarde 14:00–18:00
                DB::table('rango_horarios')->insert([
                    'id_horario'  => $idHorario,
                    'hora_inicio' => '14:00:00',
                    'hora_fin'    => '18:00:00',
                    'created_at'  => now(),
                    'updated_at'  => now(),
                ]);
            }
        }
    }
}
