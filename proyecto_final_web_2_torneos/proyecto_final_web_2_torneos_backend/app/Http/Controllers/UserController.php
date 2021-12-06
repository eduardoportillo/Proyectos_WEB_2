<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function index()
    {
        $listaUsuario = User::all();
        return response()->json($listaUsuario);
    }


    public function show($id)
    {
        $user = User::find($id);
        if ( $user == null) {
            return response()->json(array("message" => "Item not found"), 404);
        }
        return response()->json( $user);
    }

    public function update(Request $request, $id)
    {
//        $persona = Persona::find($id);
//        if ($persona == null) {
//            return response()->json(array("message" => "Item not found"), Response::HTTP_NOT_FOUND);
//        }
//        if ($request->method() == 'PUT') {
//            $validator = Validator::make($request->json()->all(), [
//                "nombres" => ['required', 'string'],
//                "apellidos" => ['required', 'string'],
//                "edad" => ['required', 'int'],
//                "ciudad" => ['required', 'string'],
//                "fechaNacimiento" => ['required', 'date'],
//            ]);
//        } else {
//            $validator = Validator::make($request->json()->all(), [
//                "nombres" => ['string'],
//                "apellidos" => ['string'],
//                "edad" => ['int'],
//                "ciudad" => ['string'],
//                "fechaNacimiento" => ['date'],
//            ]);
//        }
//        if ($validator->fails()) {
//            return response()->json($validator->messages(), Response::HTTP_BAD_REQUEST);
//        }
//        $persona->fill($request->json()->all());
//        $persona->save();
//        return response()->json($persona);
    }

    public function destroy($id)
    {
//        $persona = Persona::find($id);
//        if ($persona == null) {
//            return response()->json(array("message" => "Item not found"), Response::HTTP_NOT_FOUND);
//        }
//        $persona->delete();
//        return response()->json(['success' => true]);
    }
}
