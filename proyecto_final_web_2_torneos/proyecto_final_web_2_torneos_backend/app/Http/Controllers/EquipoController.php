<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use App\Models\Partida;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EquipoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function index(){
        $equipo = Equipo::all();
        return response()->json($equipo);
    }

    public function  equipoByTorneo(Request $request){
        $equipoByTorneo =  Equipo::select('equipos.*')->join('torneos',  'torneo_id', '=', 'torneos.id')->where('torneos.id','=', $request->get("torneo_id"))->get();
        return response()->json($equipoByTorneo);
    }

    public function store(Request $request)
    {
        $equipo = new Equipo($request->json()->all());
        $user = $request->user();
        $validator = Validator::make($request->json()->all(), [
            "torneo_id" => ['required', 'int'],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages(), 400);
        }
        $equipo->user_id = $user->id;

        $equipo->save();
        return response()->json($equipo);
    }

    public function show(Equipo $id)
    {
        $equipo = Equipo::find($id);
        if($equipo==null){
            return response()->json(array('message' =>"Item not found"),404);
        }
        return response()->json($equipo);
    }

    public function update(Request $request, $id)
    {
        $equipo = Equipo::find($id);
        if ($equipo == null) {
            return response()->json(array("Error" => "Item not found"), 404);
        }

        $validator = Validator::make($request->json()->all(), [
                    "nombre_equipo" => ['required', 'string']
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages(), 400);
        }

        $equipo->fill($request->json()->all());
        $equipo->save();
        return response()->json($equipo);
    }

    public function destroy($id)
    {
        $equipo = Equipo::find($id);
        if ($equipo == null) {
            return response()->json(array("message" => "Item not found"), 404);
        }
        $equipo->delete();
        return response()->json(['delete_success' => true]);
    }
}
