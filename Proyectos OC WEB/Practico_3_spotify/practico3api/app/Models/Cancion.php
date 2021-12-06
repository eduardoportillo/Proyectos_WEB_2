<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cancion extends Model
{
    protected $fillable=['titulo','artistaId'];
    use HasFactory;
    protected $hidden = ['created_at', 'updated_at'];

    public function artista(){
        return $this->belongsTo(Artista::class,'artistaId');
    }
}
