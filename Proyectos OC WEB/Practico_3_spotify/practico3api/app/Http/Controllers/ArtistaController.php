<?php

namespace App\Http\Controllers;

use App\Models\Artista;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ArtistaController extends Controller
{
    public function index($generoId)
    {
        if("0"==$generoId){
            $listaArtista = Artista::with('cancion','genero')->get();
        }else {
            $listaArtista = Artista::with('cancion', 'genero')->where('generoId', $generoId)->get();
        }
        return $listaArtista;
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->json()->all(),[
            "nombre"=>['required','string'],
            "generoId"=>['required','int','min:1'],
        ]);
        if($validator->fails()) {
            return response()->json($validator->messages(), Response::HTTP_BAD_REQUEST);
        }
        $artista = new Artista($request->json()->all());
        $artista->save();
        return response()->json($artista);
    }


    public function show($id)
    {
        $artista = Artista::find($id);
        if($artista==null){
            return response()->json(array('message' =>"Item not found"),Response::HTTP_NOT_FOUND);
        }
        return response()->json($artista);
    }


    public function update(Request $request, $id)
    {
        $artista = Artista::find($id);
        if($artista==null){
            return response()->json(array('message' =>"Item not found"),Response::HTTP_NOT_FOUND);
        }

        if($request->method() == 'PUT') {
            $validator = Validator::make($request->json()->all(),[
                "nombre"=>['required','string'],
                "generoId"=>['required','int'],
            ]);

        }else{
            $validator = Validator::make($request->json()->all(),[
                "nombre"=>['string'],
                "generoId"=>['int'],
            ]);
        }

        if($validator->fails()) {
            return response()->json($validator->messages(), Response::HTTP_BAD_REQUEST);
        }
        
        $artista->fill($request->json()->all());
        $artista->save();
        return response()->json($artista);
    }


    public function destroy($id)
    {
        $artista = Artista::find($id);
        if($artista==null){
            return response()->json(array('message' =>"Item not found"),Response::HTTP_NOT_FOUND);
        }
        $artista->delete();
        return response()->json(['success'=>true]);
    }
    public function subirFoto(Request $request,$id){
        $objGenero = Artista::find($id);
        if($objGenero==null){
            return response()->json(array('message' =>"Item not found"),Response::HTTP_NOT_FOUND);
        }
        if($request->hasFile("image")){
            $file = $request->file("image");
            $photoName=$id . ".jpg";
            Storage::disk('public')->put('img/artistas/'.$photoName,(string)file_get_contents($file));
            return response()->json(["res"=>"succes"]);
        }
        return response()->json(["message"=>'Image not found'],Response::HTTP_BAD_REQUEST);
    }
}
