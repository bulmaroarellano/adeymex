<?php

namespace App\Http\Controllers;

use App\Models\Gasto;
use App\Models\Pago;
use Illuminate\Http\Request;

class CajaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $efectivo     = array_sum(Pago::where('metodo_pago', 'Efectivo')->pluck('precio_total_sucursal')->toArray());
        $transferencia = array_sum(Pago::where('metodo_pago', 'Transferencia')->pluck('precio_total_sucursal')->toArray());
        $tarjeta_debito = array_sum(Pago::where('metodo_pago', 'Tarjeta de debito')->pluck('precio_total_sucursal')->toArray());
        $tarjeta_credito = array_sum(Pago::where('metodo_pago', 'Tarjeta de credito')->pluck('precio_total_sucursal')->toArray());

    
        $gastos = array_sum(Gasto::all()->pluck('monto_gasto')->toArray());

        $total = ($efectivo - $gastos) + $transferencia + $tarjeta_debito + $tarjeta_credito;
        $efectivo -= $gastos;
        return view('/paqueteria/administracion/caja/index', [
            'dinero_efectivo' => $efectivo, 
            'dinero_tranferencia' => $transferencia, 
            'dinero_tarjeta_debito' => $tarjeta_debito, 
            'dinero_tarjeta_credito' => $tarjeta_credito, 
            'total' => $total, 
            
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
