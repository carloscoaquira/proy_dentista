<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class usuarios extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'usuarios';
    protected $primaryKey = 'id_usuario';

    // CORRECCIÓN: fillable (no filliable)
    protected $fillable = [
        'nombre',
        'apellido',
        'email',
        'telefono',
        'password',
        'id_rol',
        'id_sucursal',
        'estado'
    ];

    /**
     * Relación con sucursal
     */
    public function sucursal()
    {
        return $this->belongsTo(sucursales::class, 'id_sucursal', 'id_sucursal');
    }

    /**
     * Horarios del doctor (solo si el usuario es rol doctor)
     */
    public function horarios()
    {
        return $this->hasMany(horarios::class, 'id_doctor', 'id_usuario');
    }

    /**
     * Relación con el rol
     */
    public function rol()
    {
        return $this->belongsTo(roles::class, 'id_rol', 'id_rol');
    }

    /**
     * Relación con especialidades (muchos a muchos)
     */
    public function especialidades()
    {
        return $this->belongsToMany(
            especialidades::class,
            'usuario_especialidad',
            'id_usuario',
            'id_especialidad'
        );
    }
}
