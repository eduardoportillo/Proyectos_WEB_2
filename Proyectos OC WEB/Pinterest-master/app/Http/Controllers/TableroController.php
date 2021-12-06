<?php

namespace App\Http\Controllers;

use App\Models\Tablero;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class TableroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(request $request)
    {
        $texto = $request->get('texto');
        $listaTableros = DB::table('tableros')
            ->leftJoin('users', 'tableros.usuario_id', '=', 'users.id')->select('tableros.id as tablero_id','tableros.nombre','tableros.usuario_id','users.id as usuario_id','users.name')->where('nombre','LIKE','%'.$texto.'%')
            ->get();//Tablero::with('users')->get();
        return view('tableros.lista', compact('listaTableros'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return
     */
    public function create()
    {
        return view('tableros.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => ['required', 'string'],
            'usuario_id' => ['required', 'int']
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $objTablero = Tablero::create($request->all());
        $objTablero->save();
        return response()->redirectTo('/tableros');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tablero  $tablero
     * @return \Illuminate\Http\Response
     */
    public function show(Tablero $tablero)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tablero  $tablero
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function edit($id)
    {
        $objTablero= Tablero::find($id);
        if ($objTablero == null) {
            return response()->redirectTo('/tableros');
        }
        return view('tableros.edit', compact('objTablero'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tablero  $tablero
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $objTablero = Tablero::find($id);
        if ($objTablero == null) {
            return response()->redirectTo('/tableros');
        }
        $validator = Validator::make($request->all(), [
            'nombre' => ['string'],
            'usuario_id' => ['int']
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        if ($request->get('nombre') != null) {
            $objTablero->nombre = $request->get('nombre');
        }
        if ($request->get('usuario_id') != null) {
            $objTablero->usuario_id = $request->get('usuario_id');
        }

        $objTablero->save();
        return response()->redirectTo('/tableros');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tablero  $tablero
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $objTablero = Tablero::find($id);
        if ($objTablero == null) {
            return response()->redirectTo('/tableros');
        }
        $objTablero->delete();
        return response()->redirectTo('/tableros');
    }

}
