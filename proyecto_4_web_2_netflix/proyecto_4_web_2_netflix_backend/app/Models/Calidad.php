<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calidad extends Model
{
    protected $fillable=['calidad'];
    use HasFactory;
    protected $hidden = ['created_at', 'updated_at'];

    public function pelicula(){
        return  $this->belongsToMany(Pelicula::class);
    }
}
