<?php

namespace App\Http\Controllers;

use App\Http\Requests\MercanciaRequest;
use App\Models\Mercancia;
use App\Models\Moneda;
use App\Models\Pais;
use App\Models\UnidadMedida;
use Illuminate\Http\Request;

class MercanciaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mercancias = Mercancia::orderBy('id', 'desc')->paginate(8);
        $monedas = Moneda::all()->pluck('moneda', 'moneda');
        $unidadMedidas = UnidadMedida::all()->pluck('unidadMedida', 'unidadMedida');
        $paises = Pais::all()->pluck('pais', 'pais');

        return view('/paqueteria/catalogos/mercancias', [
            'mercancias' => $mercancias, 
            'monedas' => $monedas,
            'unidadMedidas' => $unidadMedidas,
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
    public function store(MercanciaRequest $request)
    {
        Mercancia::create($request->all());
        return redirect()->route('mercancias.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mercancia  $mercancia
     * @return \Illuminate\Http\Response
     */
    public function show(Mercancia $mercancia, $edit)

    {
        $monedas = Moneda::all()->pluck('moneda', 'moneda');
        $unidadMedidas = UnidadMedida::all()->pluck('unidadMedida', 'unidadMedida');
        $paises = Pais::all()->pluck('pais', 'pais');
        return redirect()->route('mercancias.index' )->with([
            'values' => $mercancia,  
            'monedas' => $monedas,
            'unidadMedidas' => $unidadMedidas,
            'paises' => $paises,
            'edit' => $edit
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mercancia  $mercancia
     * @return \Illuminate\Http\Response
     */
    public function edit(Mercancia $mercancia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Mercancia  $mercancia
     * @return \Illuminate\Http\Response
     */
    public function update(MercanciaRequest $request, Mercancia $mercancia)
    {
        $mercancia->update($request->all());
        return redirect()->route('mercancias.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mercancia  $mercancia
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mercancia $mercancia)
    {
        $mercancia->delete();
        return redirect()->route('mercancias.index');
    }
}
