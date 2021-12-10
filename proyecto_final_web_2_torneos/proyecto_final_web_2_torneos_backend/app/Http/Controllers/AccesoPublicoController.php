<?php

namespace App\Http\Controllers;

use App\Models\Torneo;
use Illuminate\Http\Request;

class AccesoPublicoController extends Controller
{
    public function torneosEnEjecucion(){
        $torneosEnEjecucion= Torneo::all()->where('estado', 'like', 'iniciado');
        return response()->json($torneosEnEjecucion);
    }
}
