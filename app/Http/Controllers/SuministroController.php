<?php

namespace App\Http\Controllers;

use App\Http\Requests\SuministroRequest;
use App\Models\Sucursal;
use App\Models\Suministro;
use Illuminate\Http\Request;

class SuministroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suministros = Suministro::orderBy('id', 'desc')->paginate(8);
        $sucursalesName = Sucursal::all()->pluck('sucursal', 'sucursal');
        return view('/paqueteria/catalogos/suministros', [
            'suministros' => $suministros, 
            'sucursalesName' => $sucursalesName, 
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SuministroRequest $request)
    {
        Suministro::create($request->all());
        return redirect()->route('suministros.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Suministro  $suministro
     * @return \Illuminate\Http\Response
     */
    public function show(Suministro $suministro, $edit)
    {
        $sucursalesName = Sucursal::all()->pluck('sucursal', 'sucursal');
        return redirect()->route('suministros.index' )->with([
            'values' => $suministro, 
            'sucursalesName' => $sucursalesName, 
            'edit' => $edit
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Suministro  $suministro
     * @return \Illuminate\Http\Response
     */
    public function edit(Suministro $suministro)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Suministro  $suministro
     * @return \Illuminate\Http\Response
     */
    public function update(SuministroRequest $request, Suministro $suministro)
    {
        $suministro->update($request->all());
        return redirect()->route('suministros.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Suministro  $suministro
     * @return \Illuminate\Http\Response
     */
    public function destroy(Suministro $suministro)
    {
        $suministro->delete();
        return redirect()->route('suministros.index');

    }
}
