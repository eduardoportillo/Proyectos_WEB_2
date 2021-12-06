<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre_equipo',
        'torneo_id'
    ];

    public function Torneo(){
        return $this->belongsTo(Torneo::class);
    }
}
