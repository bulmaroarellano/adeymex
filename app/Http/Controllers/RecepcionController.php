<?php

namespace App\Http\Controllers;

use App\Models\Recepcion;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class RecepcionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('/paqueteria/envios/recepcion/index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('/paqueteria/envios/recepcion/create');
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

        $fecha = date_format(date_create($request->fecha_recepcion), 'Y-m-d');
        $paquetes = $request->cantidad_paquetes;
        $guias = $request->numero_guia;
        $costos = $request->costo;
        $observaciones = $request->observaciones;
        
        foreach ($paquetes  as $key => $paquete) {
            
            
            Recepcion::create([
                'paqueteria' => $request->paqueteria, 
                'numero_paquetes' => $paquete, 
                'fecha' => $fecha, 
                'numero_guia' => $guias[$key], 
                'precio' => $costos[$key], 
                'observaciones' => $observaciones[$key], 
            ]);

        }
        return view('/paqueteria/envios/recepcion/index');
        
    }

    public function getRecepciones(Request $request)
    {
        if ($request->ajax()) {
            $data  = Recepcion::get();

            return Datatables::of($data)
                ->addColumn('action', function ($recepcion) {

                    $badges = '    
                        <a href=" ' . route('recepciones.show', $recepcion) . ' "> <i class="far fa-eye "></i> </a>
                
                    ';
                    return $badges;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Recepcion  $recepcion
     * @return \Illuminate\Http\Response
     */
    public function show(Recepcion $recepcion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Recepcion  $recepcion
     * @return \Illuminate\Http\Response
     */
    public function edit(Recepcion $recepcion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Recepcion  $recepcion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Recepcion $recepcion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Recepcion  $recepcion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Recepcion $recepcion)
    {
        //
    }
}
