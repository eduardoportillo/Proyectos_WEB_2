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

    public function index()
    {
        $listaUsuario = Torneo::all();
        return response()->json($listaUsuario);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->json()->all(), [
            "nombre" => ['required', 'string'],
            "juego_torneo" => ['required', 'string'],
            "fecha_inicio" => ['required', 'date'],
            "fecha_fin" => ['required', 'date'],
            "creador_user_id" => ['required', 'int'],
//            "estado" => ['required', 'string'],
//            "puntuacion_victoria" => ['required', 'int'],
//            "puntuacion_empate" => ['required', 'int'],
//            "puntuacion_derrota" => ['required', 'int'],
            "modalidad_torneo" => ['required', 'string'],
            "nro_equipos" => ['required', 'int'],
//            "num_partidos" => ['required', 'int']
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages(), Response::HTTP_BAD_REQUEST);
        }

        $torneo = new Torneo($request->json()->all());

        // el estado al iniciar sera creado (posteriormente se vera como fluye los estados "Creado, Registro abierto, iniciado, finalizado")
        $torneo->estado = "Creado";

        // ver si los 3 tipos de puntacion va a ser hardCodeado.
        $torneo->puntuacion_victoria = 3;
        $torneo->puntuacion_empate   = 1;
        $torneo->puntuacion_derrota  = 0;

        if($request->json()->get('modalidad_torneo')==="Rondas Suizas"){
            //Generar Rondas y num partidos segun jugadores
            if ($request->json()->get('nro_equipos')===4 || ($request->json()->get('nro_equipos') % 2) == 0){
                //corre logica de generacion de Rondas Suizas

                $torneo->num_partidos = 18; //se inserta la cantidad de partidos que bote el metodo de generacion de rondas.
            }else{
                return response()->json(array('message' =>"El Torneo tiene menos de 4 Equipos o un numero de equipo impar"),201);
            }
        }

        if($request->json()->get('modalidad_torneo')==="Eliminación Simple o Directa"){
            //Generar Rondas y num partidos segun jugadores
            if ($request->json()->get('nro_equipos')===4 || ($request->json()->get('nro_equipos') % 2) == 0){
                //corre logica de generacion de rondas Eliminación Simple o Directa

               //$torneo->num_partidos = 18; //se inserta la cantidad de partidos que bote el metodo de generacion de rondas.
            }else{
                return response()->json(array('message' =>"El Torneo tiene menos de 4 Equipos o un numero de equipo impar"),201);
            }
        }

        if($request->json()->get('modalidad_torneo')==="Round Robin (Todos contra todos)"){
            //Generar Rondas y num partidos segun jugadores
            if ($request->json()->get('nro_equipos')===4 || ($request->json()->get('nro_equipos') % 2) == 0){
                //corre logica de generacion de rondas Round Robin (Todos contra todos)
                //$torneo->num_partidos = 18; //se inserta la cantidad de partidos que bote el metodo de generacion de rondas.

            }else{
                return response()->json(array('message' =>"El Torneo tiene menos de 4 Equipos o un numero de equipo impar"),201);
            }
        }

        $torneo->save();
        return response()->json($torneo);
    }

    public function show($id)
    {
        $torneo = Torneo::find($id);
        if($torneo==null){
            return response()->json(array('message' =>"Item not found"),Response::HTTP_NOT_FOUND);
        }
        return response()->json($torneo);
    }

    public function update(Request $request, Torneo $equipo)
    {
        //
    }

    public function destroy(Torneo $equipo)
    {
        //
    }
}
