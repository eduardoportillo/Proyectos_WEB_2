<?php

namespace App\Http\Controllers;

use App\Models\Torneo;
use Illuminate\Http\Request;

class GenerateRondaController extends Controller
{
    public function generateRondasSuizas($nro_equipos){
        $numRondas = log($nro_equipos, 2);
        return array("Mensaje"=>"Entraste a RondasSuizas");
    }

    public function generateEliminacionSimple(Torneo $torneo ){
        return array("Mensaje"=>"Entraste a EliminacionSimple");
    }

    public function generateRoundRobin($nro_equipos){
        return array("Mensaje"=>"Entraste a RoundRobin");
    }
}
