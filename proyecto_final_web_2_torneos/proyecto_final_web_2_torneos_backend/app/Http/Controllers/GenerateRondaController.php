<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use App\Models\Partida;
use App\Models\Torneo;
use Illuminate\Http\Request;

class GenerateRondaController
{
//    public function generateRondasSuizas($nro_equipos){
//        $numRondas = log($nro_equipos, 2);
//        return array("Mensaje"=>"Entraste a RondasSuizas");
//    }

    public static function generateEliminacionSimple(Torneo $torneo ){
//        $nro_equipos = $torneo->nro_equipos;
        $equipoByTorneo =  json_decode(Equipo::select('equipos.*')->where('equipos.torneo_id','=',$torneo->id)->get());

        self::eliminacioSimplesRecursivo($equipoByTorneo, 0, $torneo->id);
        return array("Mensaje"=>"Entraste a EliminacionSimple");
    }

    public static function generateRoundRobin($torneo){
        $equipoByTorneo =  json_decode(Equipo::select('equipos.*')->where('equipos.torneo_id','=',$torneo->id)->get());
        self::rrr($equipoByTorneo,$torneo->id);
        return array("Mensaje"=>"Entraste a RoundRobin");
    }

    public static function eliminacioSimplesRecursivo(array $equipoByTorneo, $nro_ronda, $torneo_id){
        $partida = new Partida();
        $partida->torneo_id = $torneo_id;
        $nro_ronda++;
        $partida->nro_ronda = $nro_ronda;
        if(count($equipoByTorneo)>2){
            $equiposTeam = array_chunk( $equipoByTorneo,count($equipoByTorneo)/2);
            $ganador_partida_1=self::eliminacioSimplesRecursivo($equiposTeam[0], $nro_ronda, $torneo_id);
            $ganador_partida_2=self::eliminacioSimplesRecursivo($equiposTeam[1], $nro_ronda, $torneo_id);
            $partida->ganador_partida_1 =$ganador_partida_1->id;
            $partida->ganador_partida_2 = $ganador_partida_2->id;

            $partida->save();
            return $partida;
        }

        $partida->id_equipo_1 = $equipoByTorneo[0]->id;
        $partida->id_equipo_2 = $equipoByTorneo[1]->id;
        $partida->save();
        return $partida;

    }

    public static function rrr(array $equipoByTorneo, $torneo_id){

        $totalEquipos = count($equipoByTorneo);


        $arrRondas = array();
        for ($j = 0; $j<$totalEquipos-1; $j++) {
            $partidosRonda = array();
            for ($i = 0; $i < ($totalEquipos / 2); $i++) {
                if($i != 0){
                    $p1 = ($i+$j)%($totalEquipos-1);
                    if($p1 == 0){
                        $p1 = ($totalEquipos-1);
                    }
                }else{
                    $p1 = $i;
                }
                $p2 = (($totalEquipos - 1)+$j) - $i;
                $p2 = $p2%($totalEquipos - 1);
                if($p2 == 0){
                    $p2 = ($totalEquipos - 1);
                }
                $equipo_1 =$equipoByTorneo[$p1];
                $equipo_2 = $equipoByTorneo[$p2];
                $ronda = $j +1;

                $partida = new Partida();
                $partida->id_equipo_1 = $equipo_1->id;
                $partida->id_equipo_2 = $equipo_2->id;
                $partida->nro_ronda = $ronda;
                $partida->torneo_id = $torneo_id;
                $partida->save();
            }
        }
    }
}
