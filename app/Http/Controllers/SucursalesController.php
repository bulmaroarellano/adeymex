<?php

namespace App\Http\Controllers;

use App\Http\Requests\SucursalRequest;
use App\Models\Pais;
use App\Models\Sucursal;
use Illuminate\Http\Request;

class SucursalesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sucursales = Sucursal::orderBy('id', 'desc')->paginate(8);
        $paises = Pais::all()->pluck('pais', 'pais');

        return view('/paqueteria/catalogos/sucursales', [
            'sucursales' => $sucursales,
            'paises' => $paises, 

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
    public function store(SucursalRequest $request)
    {
        // return $request;
        Sucursal::create($request->all());
        return redirect()->route('sucursales.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Sucursal $sucursal, $edit)
    {
        $paises = Pais::all()->pluck('pais', 'pais');
        
        return redirect()->route('sucursales.index')->with([
            'values' => $sucursal, 
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
    public function edit(Sucursal $sucursal)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SucursalRequest $request, Sucursal $sucursal)
    {
        $sucursal->update($request->all());
        return redirect()->route('sucursales.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sucursal $sucursal)
    {
        // return $sucursal;
        $sucursal->delete();
        return redirect()->route('sucursales.index');
    }
}
