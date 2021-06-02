<?php

namespace App\Http\Controllers;

use App\Models\Envio;
use App\Models\Sepomex;
use App\Models\Sucursal;
use Illuminate\Http\Request;
use App\Helpers\Helper;
use App\Models\Destinatario;
use App\Models\Estado;
use App\Models\Pago;
use App\Models\Remitente;
use App\Services\DhlEnvio;
use stdClass;



use App\Services\FedexEnvios;
use Barryvdh\DomPDF\Facade as PDF;
use Yajra\DataTables\Facades\DataTables;

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
            
            $data->cp_destinatario = $codigoSelect[0]->d_codigo;
            $data->id_cp_destinatario = $codigoSelect[0]->id;

            return response()->json($data);
        }
    }

    public function selecPaqueteria(Request $request)
    {


        return redirect()->route('envios.index')->with([
            'paqueteria' =>  $request->paqueteria
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

    //+ GUARDAR UN NUEVO ENVIO
    public function store(Request $request)
    {
        
        // return $request;

        //+  FUNCIONES 
        $sucursal = Sucursal::where('id', $request->sucursal_id)->first();
        $remitente = Remitente::where('id', $request->remitente_id)->first();
        $destinatario = Destinatario::where('id', $request->destinatario_id)->first();
        $precios = new stdClass();
        
        $precios->costo_sucursal_envio = $request->costo_sucursal_envio;
        $precios->cargo_logistica_interna = $request->cargo_logistica_interna;
        
        $precios->impuestos_envio = $request->impuestos_envio;
        $precios->precio_total_sucursal = $request->precio_total_sucursal;

        
        if ($request->nombre_paqueteria == "fedex") {

            $tipoPaquete = Helper::getTipoPaquete($request->type_paquete_fedex); 
            $precios->cargos_envio = $request->cargos_envio;
            $processShipmentReply = $this->getEnvioFedex($request, $remitente, $destinatario, $tipoPaquete);
            $successEnvio = $processShipmentReply->HighestSeverity;

            if ( $successEnvio == "SUCCESS" || $successEnvio == "WARNING" || $successEnvio == "NOTE" ) {
                //CREAR UN NUEVO ENVIO
                $numberTracking = $processShipmentReply->CompletedShipmentDetail->MasterTrackingId->TrackingNumber;
                $urlGuia = "fedex-guias/envio-{$numberTracking}.pdf";
                file_put_contents($urlGuia, $processShipmentReply->CompletedShipmentDetail->CompletedPackageDetails[0]->Label->Parts[0]->Image);
                // return [$request->all()];
                
                $varEnvio = $request->all();        
                $varEnvio['tipo_paquete'] = 'YOUR_PACKING';
                $varEnvio['numero_guia'] = $numberTracking;
                $varEnvio['url_guia'] = $urlGuia;
                $varEnvio['origen_cp_envio'] = '50000';
                $varEnvio['destino_cp_envio'] = $request->destinatario_codigo_postal;
                
                Envio::create($varEnvio);

                return redirect()->route('envios.index')->with([
                    'processShipmentReply' => $processShipmentReply,
                    'successEnvio' => $successEnvio,
                    'urlGuia' => $urlGuia, 
                    'precios' => $precios,
                    'paqueteria' => $request->nombre_paqueteria,
                ]);
    
            } else {
                // ENVIAR UN ERROR 
                
            }


        }

        if ($request->nombre_paqueteria == "dhl") {
            

            $requestShipment = $this->getEnvioDhl($request, $remitente, $destinatario);
            $successEnvio = $requestShipment['Note']['ActionNote'];
            // return $successEnvio;

            if ($successEnvio == "Success") {

                $numberTracking = $requestShipment['AirwayBillNumber'];
                $urlGuia = "dhl-guias/envio-{$numberTracking}.pdf";
                file_put_contents($urlGuia, base64_decode($requestShipment['LabelImage']['OutputImage']));

                $varEnvio = $request->all();        
                $varEnvio['tipo_paquete'] = 'YOUR_PACKAGING';
                $varEnvio['numero_guia'] = $numberTracking;
                $varEnvio['url_guia'] = $urlGuia;
                $varEnvio['origen_cp_envio'] = '50000';
                $varEnvio['destino_cp_envio'] = $request->destinatario_codigo_postal;
                $varEnvio['tipo_servicio'] = $requestShipment['ProductShortName'];
                Envio::create($varEnvio);

                return redirect()->route('envios.index')->with([
                    'requestShipment' => $requestShipment,
                    'successEnvio' => $successEnvio,
                    'urlGuia' => $urlGuia, 
                    'precios' => $precios,
                    'paqueteria' => $request->nombre_paqueteria
                ]);

            }else{
                // ENVIAR UN ERROR 
            }


        }

        

        

        
      
        
        

        


    }

    public function getEnvioFedex($request, $remitente, $destinatario, $tipoPaquete)
    {
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

        $ciudad = Sepomex::where('id', $request->id_cp_destinatario)->value('D_mnpio');
        $abreviacion = Estado::where('nombre', $ciudad)->value('abreviacion');
        
        $envio->destinatarioEnvio(
            [$request->destinatario_domicilio1, $request->destinatario_domicilio2, $request->destinatario_domicilio3],  // direcciones -domicilio1,2, 3
            $ciudad,
            $abreviacion,    // state code 
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
        $envio->descEnvio($request->tipo_servicio, $tipoPaquete);
        $processShipmentReply =  $envio->peticionEnvio();

        return $processShipmentReply;
    }

    public function getEnvioDhl($request, $remitente, $destinatario)
    {
        $ciudad = Sepomex::where('id', $request->id_cp_destinatario)->value('D_mnpio');
        
        $envio = new DhlEnvio('v62_9kV6umb2sA', 'ooc0Yf6DHG');
        $envio->facturacion('980055830');
        $envio->setDestinatario(
            $request->destinatario_empresa,
            substr($request->destinatario_domicilio1, 0, 20),
            $ciudad,
            $request->destinatario_codigo_postal,
            'MX', 
            'MEXICO',
            substr($request->destinatario_nombre_completo, 0, 20), 
            $request->destinatario_telefono, 
            $request->destinatario_email
        );

        $envio->setPaquete($request->peso_paquete, $request->largo_paquete, $request->ancho_paquete, $request->alto_paquete);
        $envio->detallesEnvio($request->peso_paquete, $request->global_product_code, $request->local_product_code, 'paquete de prueba');
        $envio->setRemitente(
            $request->remitente_id, 
            $request->remitente_empresa, 
            'Col. Centro', 
            'Toluca de Lerdo', 
            '50000', 
            substr($request->remitente_nombre_completo, 0, 20), 
            $request->remitente_telefono, 
            $request->remitente_email
        );

        $requestShipment = $envio->getEnvio();

        return $requestShipment;

    }

    public function ticket(Request $request)
    {
        
        return $request;
        $pdf = PDF::loadView('paqueteria.envios.components.ticket_pago', [
            'costo_sucursal' => $this->precios->costo_sucursal_envio ?? '0', 
            'cargo_logistica' => $this->precios->cargo_logistica_interna, 
            'cargo_envio' => $this->precios->cargos_envio, 
            'impuesto' => $this->precios->impuestos_envio, 
            'total_precio' => $this->precios->precio_total_sucursal, 
        ])->setPaper('A5', 'portrait');
        return $pdf->download('ticket.pdf');

    }

    public function listEnvios(){ return view('/paqueteria/envios/envios'); }
        
    

    public function getEnvios(Request $request)
    {
        if ($request->ajax()) {
            $data = Envio::latest()->get();
            for ($i=0; $i < count($data); $i++) { 
                $data[$i]['sucursal_id'] = Sucursal::where('id', $data[$i]['sucursal_id'])->get();
                $data[$i]['remitente_id'] = Remitente::where('id', $data[$i]['remitente_id'])->get();
                $data[$i]['destinatario_id'] = Destinatario::where('id', $data[$i]['destinatario_id'])->get();
                $data[$i]['pago_id'] = Pago::where('id', $data[$i]['pago_id'])->get();
            }
           
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($envio) {
                    $actionBtn = '
                    <td class="">
                    <form action=" ' . route('envios.destroy', $envio) . ' " method="POST" class = "d-flex justify-content-around">
                        <a href=" ' . route('envios.show', [$envio, '0']) . ' "> <i class="far fa-eye "></i> </a>
                        ' . csrf_field() . '
                        ' . method_field('delete') . '
                        <button class="" style="color: rgb(209, 3, 3);">
                            <i class="far fa-trash-alt"></i>
                        </button>
                        </form>
                    </td> ';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
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
