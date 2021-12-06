<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModalidadTorneo extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_modalidad'
    ];

    // 1 modalidad a N Torneos
    public function modalidadTorneo(){
        return $this->hasMany(Torneo::class);
    }
}
