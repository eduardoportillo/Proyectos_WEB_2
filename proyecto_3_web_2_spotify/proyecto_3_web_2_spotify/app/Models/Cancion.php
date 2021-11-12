<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cancion extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'titulo_cancion',
        'artista_id',
        'path_audio',
        'path_imagen_cancion'
    ];

    public function artista(){
        return $this->belongsTo(Artista::class);
    }
}
