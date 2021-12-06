<?php

namespace App\Http\Controllers;

use App\Models\Cancion;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CancionController extends Controller
{
    public function index($artistaId)
    {
        if("0"==$artistaId){
            $listaCancion = Cancion::with('artista')->get();
        }else {
            $listaCancion = Cancion::with('artista')->where('artistaId',$artistaId)->get();
        }
        return $listaCancion;
    }


    public function create()
    {

    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->json()->all(),[
            "titulo"=>['required','string'],
            "artistaId"=>['required','int','min:1'],
        ]);
        if($validator->fails()) {
            return response()->json($validator->messages(), Response::HTTP_BAD_REQUEST);
        }
        $cancion = new Cancion($request->json()->all());
        $cancion->save();
        return response()->json($cancion);
    }


    public function show($id)
    {
        $cancion = Cancion::find($id);
        if($cancion==null){
            return response()->json(array('message' =>"Item not found"),Response::HTTP_NOT_FOUND);
        }
        return response()->json($cancion);
    }


    public function edit(Cancion $cancion)
    {
        //
    }


    public function update(Request $request, $id)
    {
        $cancion = Cancion::find($id);
        if($cancion==null){
            return response()->json(array('message' =>"Item not found"),Response::HTTP_NOT_FOUND);
        }

        if($request->method() == 'PUT') {
            $validator = Validator::make($request->json()->all(),[
                "titulo"=>['required','string'],
                "artistaId"=>['required','int'],
            ]);
        }else{
            $validator = Validator::make($request->json()->all(),[
                "titulo"=>['string'],
                "artistaId"=>['int'],
            ]);
        }

        if($validator->fails()) {
            return response()->json($validator->messages(), Response::HTTP_BAD_REQUEST);
        }
        $cancion->fill($request->json()->all());
        $cancion->save();
        return response()->json($cancion);
    }


    public function destroy($id)
    {
        $cancion = Cancion::find($id);
        if($cancion==null){
            return response()->json(array('message' =>"Item not found"),Response::HTTP_NOT_FOUND);
        }
        $cancion->delete();
        return response()->json(['success'=>true]);
    }
    public function subirArchivo(Request $request,$id){
        $objGenero = Cancion::find($id);
        if($objGenero==null){
            return response()->json(array('message' =>"Item not found"),Response::HTTP_NOT_FOUND);
        }
        if($request->hasFile("archivo")){
            $file = $request->file("archivo");
            $archivo=$id . ".mp3";
            Storage::disk('public')->put('song/'.$archivo,(string)file_get_contents($file));
            return response()->json(["res"=>"succes"]);
        }
        return response()->json(["message"=>'Image not found'],Response::HTTP_BAD_REQUEST);
    }
}
