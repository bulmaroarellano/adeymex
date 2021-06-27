<?php

namespace App\Http\Controllers;

use App\Models\Envio;
use App\Models\Pago;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use stdClass;

class PagoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

        
        $suministros = json_decode($request->suministros);
        
        $this->loadSuministros($suministros);
     
        $values = new stdClass();
        $values->metodo_pago    = $request->metodo_pago;
        $values->cantidad_pago = $request->cantidad_pago;
        $values->referencia_pago         = $request->referencia_pago;

        $precios = new stdClass();
        $precios->costo_sucursal_envio    = $request->costo_sucursal_envio;
        $precios->cargo_logistica_interna = $request->cargo_logistica_interna;
        $precios->impuestos_envio         = $request->impuestos_envio;
        $precios->precio_total_sucursal   = $request->precio_total_sucursal;
        $precios->cargos_envio            = $request->cargos_envio ?? '0';
        
        
        $envio = json_decode($request->nuevo_envio, true);
        $nuevoPago = Pago::create($request->all());
        Envio::where('id', $envio['id'])->update(['pago_id' => $nuevoPago->id]);

        // Genera Ticket 
        $pago = Pago::select(
            'metodo_pago',
            'cantidad_pago',
            'costo_sucursal_envio',
            'impuestos_envio',
            'cargo_logistica_interna'
        )->where('id', $nuevoPago->id)->first();

        $urlTicket = "tickets/{$envio['master_guia']}";
        $pdf = PDF::loadView('paqueteria.envios.components.ticket', ['pago' => $pago])->setPaper('a5');
        file_put_contents( $urlTicket, $pdf->output() );
        // return $pdf->stream();
        
        // return redirect()->route('envios.lista');
        return redirect()->route('envios.index')->with([
         
            'pagos'     => $values,
            'ticket'     => $urlTicket,
        
        ]);

    }

    public function loadSuministros($suministros)
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pago  $pago
     * @return \Illuminate\Http\Response
     */
    public function show(Pago $pago)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pago  $pago
     * @return \Illuminate\Http\Response
     */
    public function edit(Pago $pago)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pago  $pago
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pago $pago)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pago  $pago
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pago $pago)
    {
        //
    }
}
