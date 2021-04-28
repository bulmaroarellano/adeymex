<?php

namespace App\Http\Controllers;

use App\Http\Requests\UnidadeMedidaRequest;
use App\Models\UnidadMedida;
use Illuminate\Http\Request;

class UnidadMedidaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $unidadesMedida = UnidadMedida::orderBy('id', 'desc')->paginate(8);
        return view('/paqueteria/catalogos/unidadesMedidas', [
            'unidadesMedida' => $unidadesMedida,
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
    public function store(UnidadeMedidaRequest $request)
    {
        UnidadMedida::create($request->all());
        return redirect()->route('unidadesMedida.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UnidadMedida  $unidadMedida
     * @return \Illuminate\Http\Response
     */
    public function show(UnidadMedida $unidadMedida, $edit)
    {

        return redirect()->route('unidadesMedida.index' )->with([
            'values' => $unidadMedida,  
            'edit' => $edit
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UnidadMedida  $unidadMedida
     * @return \Illuminate\Http\Response
     */
    public function edit(UnidadMedida $unidadMedida)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UnidadMedida  $unidadMedida
     * @return \Illuminate\Http\Response
     */
    public function update(UnidadeMedidaRequest $request, UnidadMedida $unidadMedida)
    {
        $unidadMedida->update($request->all());
        return redirect()->route('unidadesMedida.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UnidadMedida  $unidadMedida
     * @return \Illuminate\Http\Response
     */
    public function destroy(UnidadMedida $unidadMedida)
    {
        $unidadMedida->delete();
        return redirect()->route('unidadesMedida.index');
    }
}
