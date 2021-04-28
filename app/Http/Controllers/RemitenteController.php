<?php

namespace App\Http\Controllers;

use App\Http\Requests\RemitenteRequest;
use App\Models\Pais;
use App\Models\Remitente;
use App\Models\Sucursal;
use Illuminate\Http\Request;

class RemitenteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $remitentes = Remitente::orderBy('id', 'desc')->paginate(8);
        $sucursalesName = Sucursal::all()->pluck('sucursal', 'sucursal');
        $paises = Pais::all()->pluck('pais', 'pais');
        return view('/paqueteria/catalogos/remitentes', [
            'remitentes' => $remitentes,
            'paises' => $paises, 
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
    public function store(RemitenteRequest $request)
    {

        Remitente::create($request->all());

        return redirect()->route('remitentes.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Remitente $remitente, $edit )
    {
        // $sucursalesName = Sucursal::get(['descripcion']);
        $sucursalesName = Sucursal::all()->pluck('sucursal', 'sucursal');
        $paises = Pais::all()->pluck('pais', 'pais');
        return redirect()->route('remitentes.index' )->with([
            'values' => $remitente, 
            'sucursalesName' => $sucursalesName,
            'paises' => $paises, 
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
    public function update(RemitenteRequest $request, Remitente $remitente)
    {

        $remitente->update($request->all());
        return redirect()->route('remitentes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Remitente $remitente)
    {
        $remitente->delete();
        return redirect()->route('remitentes.index');

    }
}
