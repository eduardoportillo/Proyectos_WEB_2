<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

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
        $user = User::find($id);
        if ($user == null) {
            return response()->json(array("message" => "Item not found"), 404);
        }
        if ($request->method() == 'PUT') {
            $validator = Validator::make($request->json()->all(), [
                "name"=>['required', 'string'],
                "last_name"=>['required', 'string'],
                "email"=>['required', 'string'],
                "password"=>['required', 'string']
            ]);
        } else {
            $validator = Validator::make($request->json()->all(), [
                "name"=>['string'],
                "last_name"=>['string'],
                "email"=>['string'],
                "password"=>['string']
            ]);
        }
        if ($validator->fails()) {
            return response()->json($validator->messages(), 400);
        }
        $user->fill($request->json()->all());
        $user->password = bcrypt($request->json("password"));
        $user->save();
        return response()->json($user);
    }

    public function destroy($id)
    {
       $user = User::find($id);
       if ($user == null) {
           return response()->json(array("message" => "Item not found"), 404);
       }
       $user->delete();
       return response()->json(['delete_success' => true]);
    }
}
