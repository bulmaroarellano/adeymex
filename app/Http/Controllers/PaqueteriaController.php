<?php

namespace App\Http\Controllers;

use App\Models\Destinatario;
use App\Models\Envio;
use App\Models\Remitente;
use Illuminate\Http\Request;

class PaqueteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $envios = Envio::paginate(5);

        return view('/paqueteria/paquetes', [
            'envios' => $envios
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('/paqueteria/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //TODO: RELIZAR VALIDACIONES DE LOS CAMPOS 
        $remitente    = Remitente::create($request->all());
        $destinatario = Destinatario::create($request->all());
        $envio        = Envio::create($request->all());

        return view('/paqueteria/show', [
            'remitente' => $remitente, 
            'destinatario' => $destinatario,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Envio $envio)
    {

        $remitente = Remitente::all()->find($envio->id);
        $destinatario = Destinatario::all()->find($envio->id);

        return view('/paqueteria/show', [
            'remitente' => $remitente, 
            'destinatario' => $destinatario,
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Envio $envio)
    {
        $remitente = Remitente::all()->find($envio->id);
        $destinatario = Destinatario::all()->find($envio->id);

        return view('/paqueteria/edit', [
            'remitente' => $remitente, 
            'destinatario' => $destinatario,
            'envio'=> $envio
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Remitente $remitente, Destinatario $destinatario, Envio $envio)
    {
        
        $remitente->update($request->all());
        $destinatario->update($request->all());
        $envio->update($request->all());

        return redirect()->route('paquetes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Envio $envio)
    {
        $remitente = Remitente::all()->find($envio->id);
        $destinatario = Destinatario::all()->find($envio->id);
        $remitente->delete();
        $destinatario->delete();
        $envio->delete();

        return redirect()->route('paquetes.index');
    }
}
