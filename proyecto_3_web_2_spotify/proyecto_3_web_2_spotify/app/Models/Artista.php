<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artista extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'nombre_artista',
        'path_foto',
        'genero_id'
    ];

    public function canciones(){
        return $this->hasMany(Cancion::class);
    }

    public function genero(){
        return $this->belongsTo(Genero::class);
    }
}
