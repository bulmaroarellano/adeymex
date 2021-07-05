<?php

namespace App\Http\Controllers;

use App\Http\Requests\EnvioRequest;
use Illuminate\Http\Request;

use App\Models\Destinatario;
use App\Models\Envio;
use App\Models\Fda;
use App\Models\Guia;
use App\Models\Insumo;
use App\Models\Invoice;
use App\Models\Pago;
use App\Models\Paquete;
use App\Models\Remitente;
use App\Models\Sucursal;
use App\Models\Suministro;
use App\Models\Ticket;
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
    public function store(EnvioRequest $request)
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
        list($precios, $varEnvio, $suministros) = $this->getObjects($request);
        

        if ($request->nombre_paqueteria == "FEDEX") {
            
            $guiaFedex = new GuiaEnvio($request, $sucursal, $this->remitente, $this->destinatario);
            // list($processShipmentReply, $successEnvio) = $guiaFedex->getEnvioFedex();
            //* masterGuia, slavesGuias , success
            list($masterGuia, $successEnvio) = $guiaFedex->getEnvioFedex();
            
            if ( !( $successEnvio == "ERROR" ) ) {
                
                
                $urlGuiaMaster = "fedex-guias/master-{$masterGuia}.pdf";
                
               
                $varEnvio['tipo_servicio']   = $request->paqueteria_code;
                $varEnvio['master_guia']     = $masterGuia;
                $varEnvio['url_master_guia'] = $urlGuiaMaster;
                
                $nuevoEnvio = Envio::create($varEnvio);
                $invoice = Invoice::where('master_guia',$nuevoEnvio->master_guia)->first();
                // return $invoice;
                return redirect()->route('envios.index')->with([
                    'nuevoEnvio'   => $nuevoEnvio,
                    'invoice'      => $invoice,
                    'successEnvio' => $successEnvio,
                    'precios'      => json_encode($precios),
                    'paqueteria'   => $request->nombre_paqueteria,
                    'suministros'   => json_encode($suministros),
                    
                ]);
    
            } 

        }

        if ($request->nombre_paqueteria == "DHL") {
            
           
            $guiaDHL = new GuiaEnvio($request, $sucursal, $this->remitente, $this->destinatario);
            list($masterGuia, $successEnvio, $tipoServicio) = $guiaDHL->getEnvioDhl();
        
            if ( $successEnvio == "Success" ) {

                $urlGuia        = "dhl-guias/envio-{$masterGuia}.pdf";
                $varEnvio['tipo_servicio'] = $tipoServicio;
                $varEnvio['master_guia']   = $masterGuia;
                $varEnvio['url_master_guia']      = $urlGuia;

                $nuevoEnvio = Envio::create($varEnvio);
                $invoice = Invoice::where('master_guia',$nuevoEnvio->master_guia)->first();

                return redirect()->route('envios.index')->with([
                    'nuevoEnvio'   => $nuevoEnvio,
                    'invoice'      => $invoice,
                    'successEnvio' => $successEnvio,
                    'urlGuia'      => $urlGuia, 
                    'precios'      => json_encode($precios),
                    'paqueteria'   => $request->nombre_paqueteria,
                    'suministros'   => json_encode($suministros),
                    
                ]);

            }
        }

        if ($request->nombre_paqueteria == "UPS") {
            return $request;
        }
        // return $request;

    }

   public function getObjects($request)
   {

        $precios = new stdClass();

        $precios->costo_sucursal_envio    = $request->costo_sucursal_envio;
        $precios->cargo_logistica_interna = $request->cargo_logistica_interna;
        $precios->impuestos_envio         = $request->impuestos_envio;
        $precios->valor_declarado         = $request->valor_declarado ;
        $precios->valor_asegurado         = $request->valor_asegurado ;
        $precios->costo_seguro            = $request->costo_seguro ;
        $precios->cargos_envio            = $request->cargos_envio ?? '0' ;

        $varEnvio = $request->all();  
        $varEnvio['paqueteria']       = $request->nombre_paqueteria;
        $varEnvio['remitente_id']     = $this->remitente->id;
        $varEnvio['destinatario_id']  = $this->destinatario->id;
        $varEnvio['tipo_paquete']     = 'YOUR_PACKING';
        $varEnvio['origen_cp_envio']  = '50000';
        $varEnvio['destino_cp_envio'] = $request->destinatario_codigo_postal;

        $suministros = array();
        
        $sumID = $request->suministro_id ??[];
        $sumCantidad = $request->suministro_cantidad;
        $sumPrecioTotal = $request->suministro_precio_total;
        $costoTotalSuministros = 0;
        foreach ($sumID as $key => $value ) {
            
            $sum = new stdClass();
            $sum->suministro_id = $value;
            $sum->suministro_cantidad = $sumCantidad[$key];
            $sum->suministro_precio_total = $sumPrecioTotal[$key];
            $costoTotalSuministros +=  (int)$sumPrecioTotal[$key];

            array_push($suministros, $sum);
        }

        $precios->precio_total_sucursal   = strval(
            (float) $request->precio_envio_total +  $costoTotalSuministros + (float)$request->costo_seguro
        );
        $precios->suministros_precio_total   = strval($costoTotalSuministros);

        return array($precios, $varEnvio, $suministros);

        

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


        // return $envio;

        $sucursal     = Sucursal::where('id', $envio->sucursal_id)->first();
        $remitente    = Remitente::where('id', $envio->remitente_id)->first();
        $destinatario = Destinatario::where('id', $envio->destinatario_id)->first();
        $pago         = Pago::where('id', $envio->pago_id)->first();
        $insumos      = Insumo::where('id', $envio->pago_id)->first();

        // $suministros  = Suministro::where('id', $insumos?->suministro_id)->get() ??[];
        // $suministros  = Suministro::where('id', $insumos? $insumos->suministro_id : '')->get() ??[];
        $guias        = Guia::where('master_guia', $envio->master_guia)->get();
        $invoice      = Invoice::where('master_guia', $envio->master_guia)->first();
        $fda          = Fda::where('envio_id', $envio->id)->first();
        $ticket       = Ticket::where('envio_id', $envio->id)->first();

        $masterPaquete = Paquete::where('numero_guia', $envio->master_guia)->first();
        $slavePaquetes = array();
        foreach ($guias as $key => $slaveGuia) {
            
            array_push($slavePaquetes, Paquete::where('numero_guia', $slaveGuia->slave_guia)->first());
        }

        // return $slavePaquetes;


        return view('/paqueteria/envios/envio-show', [
            'masterGuia' => $envio->master_guia,
            'urlMasterGuia' => $envio->url_master_guia,
            'masterPaquete' => $masterPaquete,
            'slavePaquetes' => $slavePaquetes,

            'guias' => $guias,
            'invoice' => $invoice,
            'fda' => $fda,

            'pago' => $pago, 
            'ticket' => $ticket, 
            
        ]);

        
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
