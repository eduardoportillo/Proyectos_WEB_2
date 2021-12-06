<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use Illuminate\Http\Request;

class EquipoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function index()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Equipo $equipo)
    {
        //
    }

    public function update(Request $request, Equipo $equipo)
    {
        //
    }

    public function destroy(Equipo $equipo)
    {
        //
    }
}
