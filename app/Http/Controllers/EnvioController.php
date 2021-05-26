<?php

namespace App\Http\Controllers;

use App\Models\Envio;
use App\Models\Sepomex;
use App\Models\Sucursal;
use Illuminate\Http\Request;
use App\Helpers\Helper;
use App\Models\Destinatario;
use App\Models\Remitente;
use stdClass;

use App\Services\FedexEnvios;

class EnvioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sucursalesName = Sucursal::all()->pluck('nombre', 'id');
        
        return view('/paqueteria/envios/envio', [
            'sucursalesName' => $sucursalesName, 
        ]);
    }


    public function getCodigosPostales(Request $request)
    {
        if ($request->ajax()) {

            $data = new stdClass();
           
            $data->cp_remitente = Sucursal::where('id', $request->id_sucursal)->value('codigo_postal');
            // $data->cp_destinatario = Sepomex::where('id', $request->id_cp_destinatario)->value('d_codigo');
            $codigoSelect = Sepomex::select('id', 'd_codigo')->where('id', 'LIKE', $request->id_cp_destinatario )->get();

            $data->cp_destinatario = $codigoSelect->d_codigo;
            $data->id_cp_destinatario = $codigoSelect->id;

            return response()->json($data);
        }
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
        return $request;


        //+  FUNCIONES 
        $sucursal = Sucursal::where('id', $request->sucursal_id)->first();
        $remitente = Remitente::where('id', $request->remitente_id)->first();
        $destinatario = Destinatario::where('id', $request->destinatario_id)->first();

        $envio = new FedexEnvios('RdrCFt8NwQuVQaSK', 'Bbd1Nb5m4ekatPZiMp9BUEI3Y', '510087860', '119072943');
        $envio->configuraciones();
        
        $envio->remitenteEnvio(
            ['Col. Centro'],
            'Toluca de Lerdo',
            'EM',
            50000,
            'MX'
        ); // direccion de la sucursal  (data --> $sucursal )

        $envio->remitenteEnvioContacto(
            $request->remitente_nombre_completo,
            $request->remitente_telefono, 
            $request->remitente_email,
            $remitente->remitente_empresa,
        ); // datos de la persona que hace el pedido 
        $ciudad = Sepomex::where('id', $request->id_cp_destinatario)->value('d_ciudad');

        $envio->destinatarioEnvio(
            [$request->destinatario_domicilio1, $request->destinatario_domicilio2, $request->destinatario_domicilio3],  // direcciones -domicilio1,2, 3
            $ciudad,
            'EM',    // state code 
            (int)$request->destinatario_codigo_postal,
            'MX'
        );
        $envio->destinatarioEnvioContacto(
            $request->destinatario_nombre_completo,
            $request->destinatario_telefono,
        );

        $envio->especificacionesPaquete(
            (int) $request->ancho_paquete,
            (int) $request->alto_paquete,
            (int) $request->largo_paquete,
            (float) $request->peso_paquete,
            'paquetePrueba'
        );
    
        $envio->impuestos();
       
        $tipoPaquete = Helper::getTipoPaquete($request->type_paquete_fedex); 

        $envio->descEnvio($request->nombreServicio, $tipoPaquete);
        
        $processShipmentReply =  $envio->peticionEnvio();
        $successEnvio = $processShipmentReply->HighestSeverity;
        
        if ($successEnvio == "SUCCESS" || $successEnvio == "WARNING") {
            //CREAR UN NUEVO ENVIO

        } else {
            // ENVIAR UN ERROR 
            
        }
        

        return redirect()->route('envios.list')->with([
            'processShipmentReply' => $processShipmentReply,
            'successEnvio' => $successEnvio,
        ]);


    }

    public function listEnvios()
    {

        return view('/paqueteria/envios/envios');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Envio  $envio
     * @return \Illuminate\Http\Response
     */
    public function show(Envio $envio, $edit)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Envio  $envio
     * @return \Illuminate\Http\Response
     */
    public function edit(Envio $envio)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Envio  $envio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Envio $envio)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Envio  $envio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Envio $envio)
    {
        //
    }
}
