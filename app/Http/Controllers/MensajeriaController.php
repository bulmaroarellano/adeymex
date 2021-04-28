<?php

namespace App\Http\Controllers;

use App\Http\Requests\MensajeriaRequest;
use App\Models\Mensajeria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MensajeriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mensajerias = Mensajeria::orderBy('id', 'desc')->paginate(8);

        return view('/paqueteria/catalogos/mensajerias', [
            'mensajerias' => $mensajerias,
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
    public function store(MensajeriaRequest $request)
    {
        $logo = $request->file('logo')->store('public/imagenes');
        $urlLogo = Storage::url($logo);
        Mensajeria::create([
            'logo' => $urlLogo, 
            'mensajeria' => $request->mensajeria,
        ]);
        return redirect()->route('mensajerias.index');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mensajeria  $mensajeria
     * @return \Illuminate\Http\Response
     */
    public function show(Mensajeria $mensajeria, $edit)
    {
        return redirect()->route('mensajerias.index')->with([
            'values' => $mensajeria, 
            'edit' => $edit
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mensajeria  $mensajeria
     * @return \Illuminate\Http\Response
     */
    public function edit(Mensajeria $mensajeria)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Mensajeria  $mensajeria
     * @return \Illuminate\Http\Response
     */
    public function update(MensajeriaRequest $request, Mensajeria $mensajeria)
    {
       
        $logo = $request->file('logo')->store('public/imagenes');
        $urlLogo = Storage::url($logo);
        $mensajeria->update([
            'logo' => $urlLogo, 
            'mensajeria' => $request->mensajeria,
        ]);
        return redirect()->route('mensajerias.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mensajeria  $mensajeria
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mensajeria $mensajeria)
    {
        $mensajeria->delete();
        return redirect()->route('mensajerias.index');

    }
}
