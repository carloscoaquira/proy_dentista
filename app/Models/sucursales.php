<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class sucursales extends Model
{
    use HasFactory;

    protected $table = 'sucursales';
    protected $primaryKey = 'id_sucursal';

    public function usuarios()
    {
        // todos los usuarios de esa sucursal (luego filtramos doctores)
        return $this->hasMany(usuarios::class, 'id_sucursal', 'id_sucursal');
    }
}

