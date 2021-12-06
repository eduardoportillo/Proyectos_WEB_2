<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeliculaSimilar extends Model
{
    protected $fillable=['pelicula_id','similar_id'];
    use HasFactory;
    protected $hidden = ['created_at', 'updated_at'];
    public function pelicula(){
        return  $this->belongsToMany(Pelicula::class);
    }
}
