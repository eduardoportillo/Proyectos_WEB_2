<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Models\Artista;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ArtistaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listaArtista = Artista::all();
        return response()->json($listaArtista);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param $destinationPath
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $artista = new Artista();

//        $validator = Validator::make($request->json()->all(), [
//            "nombre_artista" => ['required', 'string'],
//            "genero_id" => ['required', 'int']
//        ]);
//        if ($validator->fails()) {
//            return response()->json($validator->messages(), Response::HTTP_BAD_REQUEST);
//        }

        if ($request->hasFile('imagen_artista')){
            $fileImagenArtista = $request->file('imagen_artista');
            $destinationPath = 'imagenes/artista/';
            $fileName = uniqid(). '-' . $fileImagenArtista->getClientOriginalName();
            $request->file('imagen_artista')->move($destinationPath, $fileName);
            $artista->path_foto = $destinationPath.$fileName;
        }else{
            return response()->json("error","es necesario una imagen");
        }

        $artista->nombre_artista = $request->nombre_artista;
        if($request->genero_id == null){
            return response()->json("error","es necesario un genero");
        }else{
            $artista->genero_id = $request->genero_id;
        }


        $artista->save();
        return response()->json($artista);
    }

    public Function RelationArtistaGenero($id){
        $objArtistaById = Artista::find($id);
        if ($objArtistaById == null) {
            return response()->json(array("message" => "Item not found"), Response::HTTP_NOT_FOUND);
        }else{
             $RelationArtistaGenero = DB::table('artistas')
                        ->join('generos', 'artistas.id','=','generos.id')
                         ->where('artistas.id', $id)->get();
             return response()->json($RelationArtistaGenero);
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $objArtistaById = Artista::find($id);
        if ($objArtistaById == null) {
            return response()->json(array("message" => "Item not found"), Response::HTTP_NOT_FOUND);
        }
        return response()->json($objArtistaById);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $artista = Artista::find($id);

        if ($request->hasFile('imagen_artista')){
            $fileImagenArtista = $request->file('imagen_artista');
            $destinationPath = 'imagenes/artista/';
            $fileName = uniqid(). '-' . $fileImagenArtista->getClientOriginalName();
            $request->file('imagen_artista')->move($destinationPath, $fileName);
            $artista->path_foto = $destinationPath.$fileName;
        }

        if ($request->get('nombre_artista') != null) {
            $artista->nombre_artista = $request->nombre_artista;
        }

        if ($request->get('genero_id') != null) {
            $artista->genero_id = $request->genero_id;
        }

        $artista->save();
        return response()->json($artista);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $artista = Artista::find($id);
        if ($artista == null) {
            return response()->json(array("message" => "Item not found"), Response::HTTP_NOT_FOUND);
        }
        $artista->delete();
        return response()->json(['success' => true, 'item_deleted' => $artista]);
    }
}
