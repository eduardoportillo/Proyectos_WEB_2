<?php

use App\Http\Controllers\PinController;
use App\Http\Controllers\TableroController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Route::resource('/tableros', TableroController::class);
Route::resource('/pins', PinController::class);
Route::get('/all_pins/{id}',[PinController::class,'pinsPorTableros'])->name('pins.all');
Route::get('/my_pins/{id}',[PinController::class,'myPins'])->name('pins.mine');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
