<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class usuarios extends Model
{
    use HasFactory;

    protected $table = 'usuarios';
    protected $primaryKey = 'id_usuario';

    protected $filliable = [
        'nombre',
        'apellido',
        'email',
        'telefono',
        'password',
        'id_rol',
        'id_sucursal',
        'estado'
    ];

    // Relación con sucursal
    public function sucursal()
    {
        return $this->belongsTo(sucursales::class, 'id_sucursal', 'id_sucursal');
    }
    // Relación con los horarios del doctor
    public function horarios()
    {
        return $this->hasMany(horarios::class, 'id_doctor', 'id_usuario');
    }
}
