<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partida extends Model
{
    use HasFactory;

    protected $fillable = [
        'fecha',
        'id_equipo_1',
        'id_equipo_2',
        'nro_ronda',
        'resultado'
    ];
}
