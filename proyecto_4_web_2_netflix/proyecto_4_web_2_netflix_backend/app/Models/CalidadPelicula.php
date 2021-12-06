<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalidadPelicula extends Model
{
    protected $fillable=['pelicula_id','calidad_id'];
    use HasFactory;
    protected $hidden = ['created_at', 'updated_at'];

}
