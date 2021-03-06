<?php

namespace App\Http\Controllers;

use App\Models\Partida;
use Illuminate\Http\Request;

class PartidaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function index()
    {
        $partida = Partida::all();
        return response()->json($partida);
    }
    public function  equipoByTorneo(Request $request){
        $equipoByTorneo =  Partida::select('partidas.*')->join('torneos',  'torneo_id', '=', 'torneos.id')->where('torneos.id','=', $request->get("torneo_id"))->get();
        return response()->json($equipoByTorneo);
    }

    public function partidaWin(Request $request){
        $partida = Partida::find($request->get("partida_id"));
        if ($partida == null) {
            return response()->json(array("Error" => "Item not found"), 404);
        }

//        $partida = Partida::select('partida.*')->where('ganador_partida_1','=', $request->get("partida_id"));

        $partida->resultado = $request->get("resultado");
        $partida->save();
        return response()->json($partida);

    }

    public function show($id)
    {
        $partida = Partida::find($id);
        if($partida==null){
            return response()->json(array('message' =>"Item not found"),404);
        }
        return response()->json($partida);
    }

    public function update(Request $request, $id)
    {
        $partida = Partida::find($id);
        if ($partida == null) {
            return response()->json(array("Error" => "Item not found"), 404);
        }

        if ($request->method() == 'PUT') {
            $validator = Validator::make($request->json()->all(), [
                "nombre"=>['required', 'string'],
                "juego_torneo"=>['required', 'string'],
                "fecha_inicio"=>['required', 'date'],
                "fecha_fin"=>['required', 'date'],
                "modalidad_torneo"=>['required', 'string'],
                "nro_equipos"=>['required', 'int']
            ]);
        } else {
            $validator = Validator::make($request->json()->all(), [
                "nombre"=>['string'],
                "juego_torneo"=>['string'],
                "fecha_inicio"=>['date'],
                "fecha_fin"=>['date'],
                "modalidad_torneo"=>['string'],
                "nro_equipos"=>['int']
            ]);

        }

        if ($validator->fails()) {
            return response()->json($validator->messages(), 400);
        }

        $partida->fill($request->json()->all());
        $partida->save();
        return response()->json($partida);
    }

    public function destroy($id)
    {
        $partida = Partida::find($id);
        if ($partida == null) {
            return response()->json(array("message" => "Item not found"), 404);
        }
        $partida->delete();
        return response()->json(['delete_success' => true]);
    }
}
