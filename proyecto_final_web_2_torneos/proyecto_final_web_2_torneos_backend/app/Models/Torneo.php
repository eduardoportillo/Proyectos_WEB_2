<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Torneo extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'juego_torneo',
        'modalidad_torneo',
        'fecha_inicio',
        'fecha_fin',
        'estado',
        'puntuacion_victoria',
        'puntuacion_empate',
        'puntuacion_derrota',
        'creador_user_id',
        'nro_equipos',
        'num_partidos'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function Equipos(){
        return $this->hasMany(Equipo::class);
    }

}
