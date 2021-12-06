<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
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

Route::get("/indexuser",[UserController::class, "index"]);

//Route::middleware('can:insert user')->post("/user/", [UserController::class, 'store']);
Route::middleware('can:list user')->get("/user/", [UserController::class, 'index']);
Route::middleware('can:update user')->match(['PUT', 'PATCH'], "/user/{id}/", [UserController::class, 'update']);
Route::middleware('can:delete user')->delete("/user/{id}", [UserController::class, 'destroy']);
Route::middleware('can:list user')->get("/user/{id}", [UserController::class, 'show']);

//auth routes
Route::post("/register", [AuthController::class, "register"])->name("register");
Route::post("/login", [AuthController::class, "login"])->name("login");



