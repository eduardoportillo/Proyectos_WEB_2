<?php

namespace App\Http\Controllers;

use App\Models\Calidad;
use Illuminate\Http\Request;

class CalidadController extends Controller
{

    public function index()
    {
        $listaCalidad = Calidad::all();
        return $listaCalidad;
    }
}
