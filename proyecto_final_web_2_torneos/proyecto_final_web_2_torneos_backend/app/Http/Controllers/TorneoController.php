<?php

namespace App\Http\Controllers;

use App\Models\Torneo;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use stdClass;

class TorneoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function index(Request $request)
    {
        $listaUsuario = Torneo::all();
        return response()->json($listaUsuario);
    }

    public function misTorneos(Request $request){
            $user = $request->user();
        $listMisTorneos =  Torneo::select('torneos.*')->join('users',  'creador_user_id', '=', 'users.id')->where('users.id','=', $user->id)->get();

        return response()->json($listMisTorneos);
    }

    public function torneosAbiertos(){
        $listMisTorneos =  Torneo::select('torneos.*')->where('estado','like','registro abierto')->get();
        return response()->json($listMisTorneos);
    }

    public function store(Request $request)
    {
        $user = $request->user();
        $validator = Validator::make($request->json()->all(), [
            "nombre" => ['required', 'string'],
            "juego_torneo" => ['required', 'string'],
//            "fecha_inicio" => ['required', 'date'],
//            "fecha_fin" => ['required', 'date'],
            "modalidad_torneo" => ['required', 'string'],
            "nro_equipos" => ['required', 'int']
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages(), Response::HTTP_BAD_REQUEST);
        }


        if($request->json()->get('nro_equipos') >= 4){
            if (($request->json()->get('nro_equipos') % 2) == 0) {
                $torneo = new Torneo($request->json()->all());

                $torneo->estado = "registro abierto";

                $torneo->puntuacion_victoria = 3;
                $torneo->puntuacion_empate   = 1;
                $torneo->puntuacion_derrota  = 0;

                $torneo->fecha_inicio = NOW();

                $torneo->creador_user_id = $user->id;

                $torneo->save();


                return response()->json($torneo);
            }else {
                return response()->json(array('Error'=>'el numero de equipos no es par'), 400);
            }
        }else{
            return response()->json(array('Error'=>'el numero de equipo es menor a 4'), 400);
        }
    }

    public function show($id)
    {
        $torneo = Torneo::find($id);
        if($torneo==null){
            return response()->json(array('message' =>"Item not found"),404);
        }
        return response()->json($torneo);
    }

    public function update(Request $request, $id)
    {
        $torneo = Torneo::find($id);
        if ($torneo == null) {
            return response()->json(array("Error" => "Item not found"), 404);
        }
        if($torneo->estado != 'iniciado'){

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

            $torneo->fill($request->json()->all());
            $torneo->save();
            return response()->json($torneo);

        }else{
            return response()->json(array('Error' =>"Torneo Iniciado. No se puede actualizar Torneos Iniciados"),400);
        }
    }

    public function destroy($id)
    {
        $torneo = Torneo::find($id);
        if ($torneo == null) {
            return response()->json(array("message" => "Item not found"), 404);
        }
        $torneo->delete();
        return response()->json(['delete_success' => true]);
    }

    public function iniciarTorneo($id){

        $torneo = Torneo::find($id);
        $estadoTorneo = "iniciado";

//        if($torneo->modalidad_torneo === "Rondas Suizas"){
//                $torneoGenerado = GenerateRondaController::generateRondasSuizas($torneo->nro_equipos);
//                return response()->json($torneoGenerado);
//            return response()->json(array("message" => "Entraste a RondasSuizas"), 200);
//        }

        if($torneo->modalidad_torneo === "Eliminación Simple"){
            $torneo->estado = $estadoTorneo;
            $torneo->save();

            GenerateRondaController::generateEliminacionSimple($torneo);
            return response()->json($torneo, 200);;
        }

        if($torneo->modalidad_torneo === "Round Robin"){
            $torneo->estado = $estadoTorneo;
            $torneo->save();
                GenerateRondaController::generateRoundRobin($torneo);
                return response()->json($torneo, 200);
        }
        return response()->json("Error al iniciar torno", 400);
    }
}
