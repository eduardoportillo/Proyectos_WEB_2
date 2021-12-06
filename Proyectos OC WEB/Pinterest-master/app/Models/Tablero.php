<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tablero extends Model
{
    use HasFactory;
    protected $fillable = ['nombre', 'usuario_id'];
    public function users()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }
    public function pins()
    {
        return $this->hasMany(Pin::class,'tablero_id');
    }
}
