<?php

use App\Http\Controllers\AccesoPublico;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TorneoController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//auth & acceso publico
Route::post("/user/register", [AuthController::class, "register"])->name("register");
Route::post("/user/login", [AuthController::class, "login"])->name("login");
Route::get("/torneosenejecucion", [AccesoPublico::class, "torneosEnEjecucion"]);

// Permisos User
Route::middleware('can:list user')->get("/users/", [UserController::class, 'index']);
Route::middleware('can:list user')->get("/user/getbyid/{id}/", [UserController::class, 'show']);
Route::middleware('can:update user')->match(['PUT', 'PATCH'], "/user/update/{id}/", [UserController::class, 'update']);
Route::middleware('can:delete user')->delete("/user/delete/{id}/", [UserController::class, 'destroy']);

// Permisos Torneo
Route::middleware('can:list torneo')->get("/torneo", [TorneoController::class, 'index']);
Route::middleware('can:list torneo')->get("/torneo/getbyid/{id}/", [TorneoController::class, 'show']);
Route::middleware('can:insert torneo')->post("/torneo/register", [TorneoController::class, 'store']);
Route::middleware('can:update torneo')->match(['PUT', 'PATCH'], "/torneo/update/{id}/", [TorneoController::class, 'update']);
Route::middleware('can:delete torneo')->delete("/torneo/delete/{id}/", [TorneoController::class, 'destroy']);

// Permisos List MisTorneos
Route::middleware('can:list user')->get('/misTorneos/{id}',[TorneoController::class, "misTorneos"]);




