<?php

use App\Http\Controllers\ArtistaController;
use App\Http\Controllers\CancionController;
use App\Http\Controllers\GeneroController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/generos/{id}/imagen',[GeneroController::class,'subirImagen'])->name("subirImgenGenero");
Route::post('/generos/',[GeneroController::class,'store']);
Route::get('/generos/',[GeneroController::class,'index']);
Route::match(['PUT','PATCH'],'/generos/{id}',[GeneroController::class,'update']);
Route::delete('/generos/{id}',[GeneroController::class,'destroy']);
Route::get('/generos/{id}',[GeneroController::class,'show']);

Route::post('/artistas/{id}/foto',[ArtistaController::class,'subirFoto'])->name("subirFotoArtista");
Route::post('/artistas/',[ArtistaController::class,'store']);
Route::get('/{id}/artistas/',[ArtistaController::class,'index']);
Route::match(['PUT','PATCH'],'/artistas/{id}',[ArtistaController::class,'update']);
Route::delete('/artistas/{id}',[ArtistaController::class,'destroy']);
Route::get('/artistas/{id}',[ArtistaController::class,'show']);

Route::post('/canciones/{id}/archivo',[CancionController::class,'subirArchivo'])->name("subirArchivoCancion");
Route::post('/canciones/',[CancionController::class,'store']);
Route::get('/{id}/canciones/',[CancionController::class,'index']);
Route::match(['PUT','PATCH'],'/canciones/{id}',[CancionController::class,'update']);
Route::delete('/canciones/{id}',[CancionController::class,'destroy']);
Route::get('/canciones/{id}',[CancionController::class,'show']);

