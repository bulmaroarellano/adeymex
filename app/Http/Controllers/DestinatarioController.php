<?php

namespace App\Http\Controllers;

use App\Models\Destinatario;
use App\Models\Sucursal;
use Illuminate\Http\Request;

class DestinatarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $destinatarios = Destinatario::orderBy('id', 'desc')->paginate(8);
        $sucursalesName = Sucursal::all()->pluck('descripcion');
        return view('/paqueteria/catalogos/destinatarios', [
            'destinatarios' => $destinatarios,
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
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
   
        Destinatario::create($request->all());
        return redirect()->route('destinatarios.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Destinatario $destinatario, $edit)
    {
        //TODO : checar cuando enviar los nombre de las sucursales 
        $sucursalesName = Sucursal::all()->pluck('descripcion');

        return redirect()->route('destinatarios.index')->with([
            'values' => $destinatario,
            'sucursalesName' => $sucursalesName ?? '',
            'edit' => $edit
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Destinatario $destinatario)
    {
        $destinatario->update($request->all());
        return redirect()->route('destinatarios.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Destinatario $destinatario)
    {
        $destinatario->delete();
        return redirect()->route('destinatarios.index');
    }
}
