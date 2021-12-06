<?php

namespace App\Http\Controllers;

use App\Models\Genero;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class GeneroController extends Controller     
{
    
    public function index()
    {
        $listaGenero = Genero::with('artista')->get();
        return $listaGenero;
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->json()->all(),[
            "nombre"=>['required','string'],
        ]);
        if($validator->fails()) {
            return response()->json($validator->messages(), Response::HTTP_BAD_REQUEST);
        }
        $genero = new Genero($request->json()->all());
        $genero->save();
        return response()->json($genero);
    }


    public function show($id)
    {
        $genero = Genero::find($id);
        if($genero==null){
            return response()->json(array('message' =>"Item not found"),Response::HTTP_NOT_FOUND);
        }
        return response()->json($genero);
    }


    public function update(Request $request, $id)
    {
        $genero = Genero::find($id);
        if($genero==null){
            return response()->json(array('message' =>"Item not found"),Response::HTTP_NOT_FOUND);
        }

        if($request->method() == 'PUT') {
            $validator = Validator::make($request->json()->all(),[
                "nombre"=>['required','string'],
            ]);
        }else{
            $validator = Validator::make($request->json()->all(),[
                "nombre"=>['string'],
            ]);
        }

        if($validator->fails()) {
            return response()->json($validator->messages(), Response::HTTP_BAD_REQUEST);
        }

        $genero->fill($request->json()->all());
        $genero->save();
        return response()->json($genero);
    }


    public function destroy($id)
    {
        $genero = Genero::find($id);
        if($genero==null){
            return response()->json(array('message' =>"Item not found"),Response::HTTP_NOT_FOUND);
        }
        $genero->delete();
        return response()->json(['success'=>true]);
    }

    public function subirImagen(Request $request,$id){
        $objGenero = Genero::find($id);
        if($objGenero==null){
            return response()->json(array('message' =>"Item not found"),Response::HTTP_NOT_FOUND);
        }
        if($request->hasFile("image")){
            $file = $request->file("image");
            $photoName=$id . ".jpg";
            Storage::disk('public')->put('img/generos/'.$photoName,(string)file_get_contents($file));
            return response()->json(["res"=>"succes"]);
        }
        return response()->json(["message"=>'Image not found'],Response::HTTP_BAD_REQUEST);
    }
}
