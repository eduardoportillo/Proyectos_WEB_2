<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artista extends Model
{
    protected $fillable=['nombre','generoId'];
    use HasFactory;
    protected $hidden = ['created_at', 'updated_at'];

    public function genero(){
        return $this->belongsTo(Genero::class,'generoId');
    }
    
    public function cancion()
    {
        return $this->hasMany(Cancion::class, 'artistaId');
    }
}
