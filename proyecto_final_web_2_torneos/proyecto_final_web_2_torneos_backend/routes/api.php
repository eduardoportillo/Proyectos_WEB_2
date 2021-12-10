<?php

use App\Http\Controllers\AccesoPublicoController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EquipoController;
use App\Http\Controllers\PartidaController;
use App\Http\Controllers\TorneoController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

//auth & acceso publico
Route::post("/user/register", [AuthController::class, "register"])->name("register");
Route::post("/user/login", [AuthController::class, "login"])->name("login");
Route::get("/torneo/iniciado", [AccesoPublicoController::class, "torneosEnEjecucion"]);

// User
Route::middleware('can:list user')->get("/user/", [UserController::class, 'index']);
Route::middleware('can:list user')->get("/user/getbyid/{id}/", [UserController::class, 'show']);
Route::middleware('can:update user')->match(['PUT', 'PATCH'], "/user/update/{id}/", [UserController::class, 'update']);
Route::middleware('can:delete user')->delete("/user/delete/{id}/", [UserController::class, 'destroy']);

// Torneo
Route::middleware('can:list torneo')->get("/torneo", [TorneoController::class, 'index']);
Route::middleware('can:list torneo')->get("/torneo/getbyid/{id}/", [TorneoController::class, 'show']);
Route::middleware('can:insert torneo')->post("/torneo/register", [TorneoController::class, 'store']);
Route::middleware('can:update torneo')->match(['PUT', 'PATCH'], "/torneo/update/{id}/", [TorneoController::class, 'update']);
Route::middleware('can:delete torneo')->delete("/torneo/delete/{id}/", [TorneoController::class, 'destroy']);

Route::middleware('can:acceso torneo MT&TO')->get('/torneo/user/',[TorneoController::class, "misTorneos"]);

Route::middleware('can:acceso torneo MT&TO')->get('/torneo/open/',[TorneoController::class, "torneosAbiertos"]);

// IniciarTorneo
Route::middleware('can:iniciar torneo')->get('/torneo/iniciar/{id}/',[TorneoController::class, "iniciarTorneo"]);

// Equipo
Route::middleware('can:list equipo')->get("/equipo", [EquipoController::class, 'index']);
Route::middleware('can:list equipo')->get("/equipo/getbyid/{id}/", [EquipoController::class, 'show']);
Route::middleware('can:insert equipo')->post("/equipo/register", [EquipoController::class, 'store']);
Route::middleware('can:update equipo')->match(['PUT', 'PATCH'], "/equipo/update/{id}/", [EquipoController::class, 'update']);
Route::middleware('can:delete equipo')->delete("/equipo/delete/{id}/", [EquipoController::class, 'destroy']);
Route::middleware('can:list equipo')->get("/equipo", [EquipoController::class, 'index']);

Route::middleware('can:list equipo')->post("/equipo/getAllByTorneo/", [EquipoController::class, 'equipoByTorneo']);

Route::middleware('can:list equipo')->post("/partida/getAllByTorneo/", [PartidaController::class, 'equipoByTorneo']);
Route::middleware('can:list equipo')->post("/partida/win/", [PartidaController::class, 'partidaWin']);

