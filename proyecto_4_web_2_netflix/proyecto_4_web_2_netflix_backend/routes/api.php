<?php

use App\Http\Controllers\CalidadController;
use App\Http\Controllers\CalidadPeliculaController;
use App\Http\Controllers\PeliculaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/peliculas/{id}/imagen',[PeliculaController::class,'subirImagen'])->name("subirImagenphpPelicula");
Route::post('/peliculas/',[PeliculaController::class,'store']);
Route::get('/peliculas/',[PeliculaController::class,'index']);
Route::match(['PUT','PATCH'],'/peliculas/{id}',[PeliculaController::class,'update']);
Route::delete('/peliculas/{id}',[PeliculaController::class,'destroy']);
Route::get('/peliculas/{id}',[PeliculaController::class,'show']);

Route::get('/calidades/',[CalidadController::class,'index']);

Route::post('/pelicula/{id}/calidad',[CalidadPeliculaController::class,'store']);
Route::delete('/pelicula/{id}/calidad',[CalidadPeliculaController::class,'destroy']);

