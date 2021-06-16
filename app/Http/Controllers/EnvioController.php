<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Models\Destinatario;
use App\Models\Envio;
use App\Models\Pago;
use App\Models\Remitente;
use App\Models\Sucursal;
use App\Services\GuiaEnvio;
use stdClass;

use Barryvdh\DomPDF\Facade as PDF;

use Yajra\DataTables\Facades\DataTables;

class EnvioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
    */

    private $remitente;
    private $destinatario;

    public function index()
    {
        $sucursalesName = Sucursal::all()->pluck('nombre', 'id');
        
        return view('/paqueteria/envios/envio', [
            'sucursalesName' => $sucursalesName, 
            
        ]);
    }




    public function selecPaqueteria(Request $request)
    {


        return $request;


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

        if (! is_numeric($request->remitente_id)) {
            
            $this->remitente = Remitente::create([
                'nombre'      => $request->remitente_id, 
                'apellido_paterno' => $request->remitente_nombre_completo, 
                'telefono'    => $request->remitente_telefono, 
                'email'       => $request->remitente_email, 
                'cliente_id'  => 1,  
                'domicilio1'  => $request->remitente_domicilio1, 
                'domicilio2'  => $request->remitente_domicilio2, 
                'domicilio3'  => $request->remitente_domicilio3, 
                'sucursal_id' => $request->sucursal_id, 
                
            ]);

        }else{ $this->remitente = Remitente::where('id', $request->remitente_id)->first(); }

        if (! is_numeric($request->destinatario_id)) {

            $this->destinatario = Destinatario::create([
                'nombre'      => $request->destinatario_id, 
                'apellido_paterno' => $request->destinatario_nombre_completo, 
                'telefono'    => $request->destinatario_telefono, 
                'email'       => $request->destinatario_email, 
                'cliente_id'  => 1,  
                'domicilio1'  => $request->destinatario_domicilio1, 
                'domicilio2'  => $request->destinatario_domicilio2, 
                'domicilio3'  => $request->destinatario_domicilio3, 
                'sucursal_id' => $request->sucursal_id, 
            ]);

        }else{ $this->destinatario = Destinatario::where('id', $request->destinatario_id)->first(); }
        
        $sucursal = Sucursal::where('id', $request->sucursal_id)->first();
        
        $precios = new stdClass();
        $precios->costo_sucursal_envio    = $request->costo_sucursal_envio;
        $precios->cargo_logistica_interna = $request->cargo_logistica_interna;
        $precios->impuestos_envio         = $request->impuestos_envio;
        $precios->precio_total_sucursal   = $request->precio_total_sucursal;
        $precios->cargos_envio            = $request->cargos_envio ?? '0';

        $varEnvio = $request->all();  
        $varEnvio['paqueteria']       = $request->nombre_paqueteria;
        $varEnvio['tipo_paquete']     = 'YOUR_PACKING';
        $varEnvio['origen_cp_envio']  = '50000';
        $varEnvio['destino_cp_envio'] = $request->destinatario_codigo_postal;

        if ($request->nombre_paqueteria == "FEDEX") {
            
            $guiaFedex = new GuiaEnvio($request, $sucursal, $this->remitente, $this->destinatario);
            list($processShipmentReply, $successEnvio) = $guiaFedex->getEnvioFedex();

            if ( !( $successEnvio == "ERROR" ) ) {
                
                $numberTracking = $processShipmentReply->CompletedShipmentDetail->MasterTrackingId->TrackingNumber;
                $urlGuia        = "fedex-guias/envio-{$numberTracking}.pdf";
                $urlGuiaInvoice = "fedex-guias/invoice-{$numberTracking}.pdf";
                
                $this->guardarGuias(
                    $urlGuia,
                    $processShipmentReply->CompletedShipmentDetail->CompletedPackageDetails[0]->Label->Parts[0]->Image,
                    'FEDEX'
                );
                // invoice 
                $this->guardarGuias(
                    $urlGuiaInvoice,
                    $processShipmentReply->CompletedShipmentDetail->ShipmentDocuments[0]->Parts[0]->Image,
                    'FEDEX'
                );
                
                

                $varEnvio['tipo_servicio'] = $request->paqueteria_code;
                $varEnvio['numero_guia']   = $numberTracking;
                $varEnvio['url_guia']      = $urlGuia;
                
                // Envio::create($varEnvio);

                // return redirect()->route('envios.index')->with([
                //     'processShipmentReply' => $processShipmentReply,
                //     'successEnvio'  => $successEnvio,
                //     'urlGuia'       => $urlGuia, 
                //     'precios'       => $precios,
                //     'paqueteria'    => $request->nombre_paqueteria,
                // ]);
    
            } 

        }

        if ($request->nombre_paqueteria == "DHL") {
            
            $guiaDHL = new GuiaEnvio($request, $sucursal, $this->remitente, $this->destinatario);
            list($requestShipment, $successEnvio) = $guiaDHL->getEnvioDhl();
        
            if ( $successEnvio == "Success" ) {

                $numberTracking = $requestShipment['AirwayBillNumber'];
                $urlGuia        = "dhl-guias/envio-{$numberTracking}.pdf";
                $urlGuiaInvoice = "dhl-guias/invoice-{$numberTracking}.pdf";

                $this->guardarGuias(
                    $urlGuia,
                    $urlGuiaInvoice,
                    $requestShipment['LabelImage']['OutputImage'],
                    $requestShipment['LabelImage']['MultiLabels']['MultiLabel']['DocImageVal'],
                    'DHL'
                );
                
                $varEnvio['tipo_servicio'] = $requestShipment['ProductShortName'];
                $varEnvio['numero_guia']   = $numberTracking;
                $varEnvio['url_guia']      = $urlGuia;

                Envio::create($varEnvio);

                return redirect()->route('envios.index')->with([
                    'requestShipment' => $requestShipment,
                    'successEnvio' => $successEnvio,
                    'urlGuia'      => $urlGuia, 
                    'precios'      => $precios,
                    'paqueteria'   => $request->nombre_paqueteria
                ]);

            }
        }

        if ($request->nombre_paqueteria == "UPS") {
            return $request;
        }
        // return $request;

    }

    public function guardarGuias($urlGuia, $contentGuia, $paqueteria)
    {
        
        if ($paqueteria == "FEDEX") {
            file_put_contents( $urlGuia, $contentGuia );
           
        }
        
        if ($paqueteria == "DHL") {
            file_put_contents( $urlGuia, base64_decode( $contentGuia ) );
            
        }
    }

    public function ticket(Request $request)
    {
        
        return $request;
        $pdf = PDF::loadView('paqueteria.envios.components.ticket_pago', [
            'costo_sucursal'  => $this->precios->costo_sucursal_envio ?? '0', 
            'cargo_logistica' => $this->precios->cargo_logistica_interna, 
            'cargo_envio'     => $this->precios->cargos_envio, 
            'impuesto'        => $this->precios->impuestos_envio, 
            'total_precio'    => $this->precios->precio_total_sucursal, 
        ])->setPaper('A5', 'portrait');
        return $pdf->download('ticket.pdf');

    }

    public function listEnvios()
    {
        

        return view('/paqueteria/envios/envios'); 
    }
        
    

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
                        <a href=" ' . route('tracking.track', $envio) . ' "> <i class="fas fa-sync"></i> </a>
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
