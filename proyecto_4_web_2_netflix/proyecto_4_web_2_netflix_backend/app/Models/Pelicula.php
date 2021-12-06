<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelicula extends Model
{
    protected $fillable=['nombre','año','calificacionRotten','calificacionIMDB','director','trailer','sinopsis'];
    use HasFactory;
    protected $hidden = ['created_at', 'updated_at'];

    public function calidad(){
        return  $this->belongsToMany(Calidad::class);
    }
    public function similar(){
        return  $this->hasMany(PeliculaSimilar::class);
    }
}
