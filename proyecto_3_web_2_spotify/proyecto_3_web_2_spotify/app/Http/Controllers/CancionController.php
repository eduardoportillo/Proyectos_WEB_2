<?php

namespace App\Http\Controllers;

use App\Models\Cancion;
use Illuminate\Http\Request;

class CancionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listaCanciones = Cancion::all();
        return response()->json($listaCanciones);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cancion = new Cancion();

        if ($request->hasFile('path_audio')){
            $fileAudioCancion = $request->file('path_audio');
            $destinationPath = 'audios/';
            $fileName = uniqid(). '-' . $fileAudioCancion->getClientOriginalName();
            $request->file('path_audio')->move($destinationPath, $fileName);
            $cancion->path_audio = $destinationPath.$fileName;
        }

        if ($request->hasFile('path_imagen_cancion')){
            $fileImagenCancion = $request->file('path_imagen_cancion');
            $destinationPath = 'imagenes/canciones/';
            $fileName = uniqid(). '-' . $fileImagenCancion->getClientOriginalName();
            $request->file('path_imagen_cancion')->move($destinationPath, $fileName);
            $cancion->path_imagen_cancion = $destinationPath.$fileName;
        }

        $cancion->nombre = $request->nombre;
        $cancion->artista_id = $request->artista_id;

        $cancion->save();
        return response()->json($cancion);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cancion  $cancion
     * @return \Illuminate\Http\Response
     */
    public function show(Cancion $id)
    {
        $objCancionById = Cancion::find($id);
        if ($objCancionById == null) {
            return response()->json(array("message" => "Item not found"), Response::HTTP_NOT_FOUND);
        }
        return response()->json($objCancionById);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cancion  $cancion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cancion $cancion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cancion  $cancion
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cancion = Cancion::find($id);
        if ($cancion == null) {
            return response()->json(array("message" => "Item not found"), Response::HTTP_NOT_FOUND);
        }
        $cancion->delete();
        return response()->json(['success' => true, 'item_deleted' => $cancion]);
    }
}
