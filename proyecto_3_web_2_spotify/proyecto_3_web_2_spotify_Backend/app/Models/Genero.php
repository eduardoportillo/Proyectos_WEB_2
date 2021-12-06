<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genero extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'nombre_genero',
        'path_imagen_genero'
    ];

    public function artistas(){
        return $this->hasMany(Artista::class);
    }
}
