<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EspecialidadesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('especialidades')->insert([
            ['nombre' => 'Odontología general', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Endodoncia',          'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Ortodoncia',          'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
