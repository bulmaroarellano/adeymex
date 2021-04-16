<?php

namespace App\Http\Controllers;

use App\Models\CodigoPostal;
use Illuminate\Http\Request;

class CodigoPostalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $codigosPostales = CodigoPostal::orderBY('id', 'desc')->paginate(8);
    
        return view('/paqueteria/catalogos/codigosPostales', [
            'codigosPostales' => $codigosPostales,
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
    public function store(Request $request)
    {
        CodigoPostal::create($request->all());

        return redirect()->route('codigosPostales.index');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CodigoPostal  $codigoPostal
     * @return \Illuminate\Http\Response
     */
    public function show(CodigoPostal $codigoPostal, $edit)
    {
        return redirect()->route('codigosPostales.index' )->with([
            'values' => $codigoPostal,  
            'edit' => $edit
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CodigoPostal  $codigoPostal
     * @return \Illuminate\Http\Response
     */
    public function edit(CodigoPostal $codigoPostal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CodigoPostal  $codigoPostal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CodigoPostal $codigoPostal)
    {
        $codigoPostal->update($request->all());
        return redirect()->route('codigosPostales.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CodigoPostal  $codigoPostal
     * @return \Illuminate\Http\Response
     */
    public function destroy(CodigoPostal $codigoPostal)
    {
        $codigoPostal->delete();
        return redirect()->route('codigosPostales.index');
    }
}
