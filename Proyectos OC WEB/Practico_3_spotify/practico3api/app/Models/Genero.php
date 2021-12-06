<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genero extends Model
{
    protected $fillable=['nombre'];
    use HasFactory;
    protected $hidden = ['created_at', 'updated_at'];

    public function artista()
    {
        return $this->hasMany(Artista::class, 'generoId');
    }
}
