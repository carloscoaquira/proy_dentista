<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class rangoHorarios extends Model
{
    use HasFactory;

    protected $table = 'rango_horarios';
    protected $primaryKey = 'id_rango_horario';

    public function horario()
    {
        return $this->belongsTo(horarios::class, 'id_horario', 'id_horario');
    }
}

