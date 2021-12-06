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
        'modalidad_torneo_id',
        'fecha_inicio',
        'fecha_fin',
        'estado',
        'puntuacion_victoria',
        'creador_user_id'
    ];

    // N a N User TorneoController
    public function users(){
        return $this->belongsToMany(User::class);
    }

    // 1 modalidad a N Torneos
    public function modalidadTorneo(){
        return $this->hasOne(ModalidadTorneo::class);
    }

}
