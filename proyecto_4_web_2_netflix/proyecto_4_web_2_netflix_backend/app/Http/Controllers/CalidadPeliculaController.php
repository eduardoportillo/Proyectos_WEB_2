<?php

namespace App\Http\Controllers;

use App\Models\CalidadPelicula;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class CalidadPeliculaController extends Controller
{
    public function index()
    {
        $listaPelicula = CalidadPelicula::all();
        return $listaPelicula;
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->json()->all(),[
            "pelicula_id"=>['required','integer'],
            "calidad_id"=>['required','integer'],
        ]);
        if($validator->fails()) {
            return response()->json($validator->messages(), Response::HTTP_BAD_REQUEST);
        }
        $calidadPelicula = new CalidadPelicula($request->json()->all());
        $calidadPelicula->save();
        return response()->json($calidadPelicula);
    }

    public function show($id)
    {
        $calidadPelicula = CalidadPelicula::find($id);
        if($calidadPelicula==null){
            return response()->json(array('message' =>"Item not found"),Response::HTTP_NOT_FOUND);
        }
        return response()->json($calidadPelicula);
    }


    public function destroy($id)
    {
        $calidadPelicula = CalidadPelicula::find($id);
        if($calidadPelicula==null){
            return response()->json(array('message' =>"Item not found"),Response::HTTP_NOT_FOUND);
        }
        $calidadPelicula->delete();
        return response()->json(['success'=>true]);
    }
}
