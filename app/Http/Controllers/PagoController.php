<?php

namespace App\Http\Controllers;

use App\Models\Envio;
use App\Models\Fda;
use App\Models\Insumo;
use App\Models\Pago;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Storage;
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
        

        $suministros = json_decode($request->suministros, true);
        $envio = json_decode($request->nuevo_envio, true);
        $precios = json_decode($request->precios, true);
        
        $pago = array_merge(
            ["metodo_pago"     => $request->metodo_pago], 
            ["referencia_pago" => $request->referencia_pago], 
            $precios
            
        );
        
        $nuevoPago = Pago::create($pago);
        $this->loadSuministros($suministros, $nuevoPago->id);
        Envio::where('id', $envio['id'])->update(['pago_id' => $nuevoPago->id]);

        // Genera Ticket 
        $pago = Pago::select(
            'metodo_pago',
            'costo_sucursal_envio',
            'cargo_logistica_interna',
            'impuestos_envio',
            'cargos_envio',
            'suministros_precio_total',
            'precio_total_sucursal'
        )->where('id', $nuevoPago->id)->first();

        $pdf = PDF::loadView('paqueteria.envios.components.ticket',[
            'pago' => $pago,
            'seguro' => $precios['costo_seguro'], 
        ])->setPaper('a8');

        if ($request->has('fda')) {

            $file = $request->file('fda'); 
            $fda = $request->file('fda')->storeAs('public/fdas', "{$envio['master_guia']}.{$file->extension()}"); 
            $urlFda = Storage::url($fda);

            Fda::create([
                'envio_id' => $envio['id'], 
                'url_fda' => $urlFda, 
            ]);
            
        }
        
        $urlTicket = "tickets/{$envio['master_guia']}.pdf";
        file_put_contents( $urlTicket, $pdf->output() );

        Ticket::create([
            'envio_id'   =>  $envio['id'], 
            'url_ticket' => $urlTicket, 
        ]);
        
        list($values) = $this->getObjects($request, $precios['precio_total_sucursal']);
        return redirect()->route('envios.index')->with([
            'pagos'     => $values,
            'ticket'     => $urlTicket,
        ]);

    }
    public function getObjects($request, $precio_total_sucursal)
    {
        $values = new stdClass();
        $values->metodo_pago       = $request->metodo_pago;
        $values->referencia_pago   = $request->referencia_pago;
        $values->precio_total_sucursal   = $precio_total_sucursal;

        return array($values);
        
    }

    public function loadSuministros($suministros, $pago_id)
    {

        foreach ($suministros as $key => $suministro) {
            $suministro['pago_id'] = $pago_id;
            Insumo::create($suministro);
        }
        
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
