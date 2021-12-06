<?php

namespace App\Http\Controllers;

use App\Models\Pelicula;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PeliculaController extends Controller
{
    public function index()
    {
        $listaPelicula = Pelicula::with('calidad','similar')->get();
        return $listaPelicula;
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->json()->all(),[
            "nombre"=>['required','string'],
            "año"=>['required','integer'],
            "calificacionRotten"=>['required','string'],
            "calificacionIMDB"=>['required','string'],
            "director"=>['required','string'],
            "trailer"=>['required','string'],
            "sinopsis"=>['required','string'],
        ]);
        if($validator->fails()) {
            return response()->json($validator->messages(), Response::HTTP_BAD_REQUEST);
        }
        $pelicula = new Pelicula($request->json()->all());
        $pelicula->save();
        return response()->json($pelicula);
    }


    public function show($id)
    {
        $pelicula = Pelicula::with('calidad','similar')->where('id', $id)->get();
        if($pelicula==null){
            return response()->json(array('message' =>"Item not found"),Response::HTTP_NOT_FOUND);
        }
        return response()->json($pelicula);
    }


    public function update(Request $request, $id)
    {
        $pelicula = Pelicula::find($id);
        if($pelicula==null){
            return response()->json(array('message' =>"Item not found"),Response::HTTP_NOT_FOUND);
        }

        if($request->method() == 'PUT') {
            $validator = Validator::make($request->json()->all(),[
                "nombre"=>['required','string'],
                "año"=>['required','integer'],
                "calificacionRotten"=>['required','string'],
                "calificacionIMDB"=>['required','string'],
                "director"=>['required','string'],
                "trailer"=>['required','string'],
                "sinopsis"=>['required','string'],
            ]);
        }else{
            $validator = Validator::make($request->json()->all(),[
                "nombre"=>['string'],
                "año"=>['integer'],
                "calificacionRotten"=>['string'],
                "calificacionIMDB"=>['string'],
                "director"=>['string'],
                "trailer"=>['string'],
                "sinopsis"=>['string'],
            ]);
        }

        if($validator->fails()) {
            return response()->json($validator->messages(), Response::HTTP_BAD_REQUEST);
        }

        $pelicula->fill($request->json()->all());
        $pelicula->save();
        return response()->json($pelicula);
    }


    public function destroy($id)
    {
        $pelicula = Pelicula::find($id);
        if($pelicula==null){
            return response()->json(array('message' =>"Item not found"),Response::HTTP_NOT_FOUND);
        }
        $pelicula->delete();
        return response()->json(['success'=>true]);
    }

    public function subirImagen(Request $request,$id){
        $objPelicula = Pelicula::find($id);
        if($objPelicula==null){
            return response()->json(array('message' =>"Item not found"),Response::HTTP_NOT_FOUND);
        }
        if($request->hasFile("image")){
            $file = $request->file("image");
            $photoName=$id . ".jpg";
            Storage::disk('public')->put('img/peliculas/'.$photoName,(string)file_get_contents($file));
            return response()->json(["res"=>"succes"]);
        }
        return response()->json(["message"=>'Image not found'],Response::HTTP_BAD_REQUEST);
    }
}
