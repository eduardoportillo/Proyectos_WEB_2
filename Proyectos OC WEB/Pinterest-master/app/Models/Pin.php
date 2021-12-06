<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pin extends Model
{
    use HasFactory;

    protected $fillable = ['titulo', 'imagen', 'url', 'tablero_id', 'usuario_id'];

    public function users()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    public function tableros()
    {
        return $this->belongsTo(Tablero::class, 'tablero_id');
    }
}
