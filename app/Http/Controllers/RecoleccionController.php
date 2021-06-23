<?php

namespace App\Http\Controllers;

use App\Models\Destinatario;
use App\Models\Envio;
use App\Models\Pago;
use App\Models\Recoleccion;
use App\Models\Remitente;
use App\Models\Sucursal;
use App\Services\Recolecciones;
use Illuminate\Http\Request;

use Yajra\DataTables\Facades\DataTables;

class RecoleccionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('/paqueteria/envios/recolecciones');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('/paqueteria/envios/recoleccion');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // return $request;

        
        
       
        if ($request->paqueteria == "FEDEX") {
            $recoleccionFedex = new Recolecciones($request);
            
            list($createPickupReply, $success, $message) = $recoleccionFedex->getPickupFedex();

            
            if ( ! ( $success == 'ERROR' )) {

                $pickupConfirmationNumber = $createPickupReply->PickupConfirmationNumber;
                $location = $createPickupReply->Location;
                $folioRecoleccion = "{$pickupConfirmationNumber}/{$location}";
                $varRecoleccion = $request->all();
                $varRecoleccion['status'] = 'GENERADO';
                $varRecoleccion['folio_recoleccion'] = $folioRecoleccion;

                $recoleccion = Recoleccion::create($varRecoleccion);


                // return view('recoleccion.index');
                return redirect()->route('recoleccion.index');

            }else{

                return view('/paqueteria/envios/recoleccion',[
                    'message' => $message
                ]); 

            }
        }

        if ($request->paqueteria == "DHL") {
            $recoleccionDHL = new Recolecciones($request);
            list($PUResponse, $success, $message) = $recoleccionDHL->getPickUpDHL();

            if ( ! ( $success == 'Error' )) {

                $confirmationNumber = $PUResponse['ConfirmationNumber'];
                $location           = $PUResponse['OriginSvcArea'];
                $folioRecoleccion   = "{$confirmationNumber}/{$location}";
                
                $varRecoleccion = $request->all();
                $varRecoleccion['status'] = 'GENERADO';
                $varRecoleccion['folio_recoleccion'] = $folioRecoleccion;

                $recoleccion = Recoleccion::create($varRecoleccion);


                // return view('recoleccion.index');
                return redirect()->route('recoleccion.index');

            }else{

                return view('/paqueteria/envios/recoleccion',[
                    'message' => $message
                ]); 

            }

        }

       
    }

    public function getRecolecciones(Request $request)
    {

        if ($request->ajax()) {
            $data = Recoleccion::latest()->get();
            for ($i=0; $i < count($data); $i++) { 
                $data[$i]['sucursal_id'] = Sucursal::where('id', $data[$i]['sucursal_id'])->get();
            }
           
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($recoleccion) {
                    $actionBtn = '
                    <td class="">
                    <form action=" ' . route('envios.destroy', $recoleccion) . ' " method="POST" class = "d-flex justify-content-around">
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

    public function getPaquetes(Request $request)
    {
        $paquetes = [];
        if ($request->ajax()) {

            // $data = Envio::latest()->get();
            $paqueteria = $request->paqueteria;
            $data = Envio::where('paqueteria', 'LIKE', "%$paqueteria%")
                    ->where('status_recoleccion', 'LIKE', 'SIN RECOLECCION')->get();
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
                        <input class="" type="checkbox" name="envio['.$envio->id.']" value='.$envio->id.'/>
                    </td> ';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
            
            

            
        }

        return response()->json($paquetes);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Recoleccion  $recoleccion
     * @return \Illuminate\Http\Response
     */
    public function show(Recoleccion $recoleccion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Recoleccion  $recoleccion
     * @return \Illuminate\Http\Response
     */
    public function edit(Recoleccion $recoleccion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Recoleccion  $recoleccion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Recoleccion $recoleccion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Recoleccion  $recoleccion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Recoleccion $recoleccion)
    {
        //
    }
}
