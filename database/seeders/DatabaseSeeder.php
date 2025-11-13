<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RolesSeeder::class,
            SucursalesSeeder::class,
            UsuariosSeeder::class,
            EspecialidadesSeeder::class,
            UsuarioEspecialidadSeeder::class,
            ClientesSeeder::class,
            HorariosSeeder::class,
            CitasSeeder::class,
        ]);
    }
}
