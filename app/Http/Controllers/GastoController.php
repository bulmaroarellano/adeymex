<?php

namespace App\Http\Controllers;

use App\Models\Gasto;
use App\Models\Pago;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
class GastoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('paqueteria/administracion/gastos/index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('paqueteria/administracion/gastos/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $file = $request->file('comprobante');
        date_default_timezone_set('America/Mexico_City');
        $fecha = date('Y-m-d-H-i-s');
        $comprobante = $file->storeAs('public/gastos', "{$request->tipo_gasto}-{$fecha}.{$file->extension()}");
        $urlComprobante  = Storage::url($comprobante);
        Gasto::create([
            'tipo_gasto' => $request->tipo_gasto, 
            'monto_gasto' => $request->monto_gasto, 
            'url_comprobante' => $urlComprobante,
            'fecha' =>  $fecha = date('Y-m-d'),  
        ]);

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

    public function getGastos(Request $request)
    {

        if ($request->ajax()) {
            $data  = Gasto::get();

            return Datatables::of($data)
                ->addColumn('comprobante', function ($gasto) {
                   
                    $badges = '
                    <td>
                        <a href='.$gasto->url_comprobante.' download>
                            <button class="btn btn-danger">
                                Comprobante
                                <i class="fas fa-file-pdf fa-sm"></i>
                            </button>
                        </a>
                    </td>';
                    

                    return $badges;
                })
                ->addColumn('action', function ($gasto) {
                    $actionBtn = '
                    <td class="">
                    <form action=" ' . route('gastos.destroy', $gasto) . ' " method="POST" class = "d-flex justify-content-around">
                        <a href=" ' . route('gastos.show', [$gasto, '0']) . ' "> <i class="far fa-eye "></i> </a>
                        <a href=" ' . route('gastos.edit', $gasto) . ' "> <i class="fas fa-pen-alt"></i> </a>
                        ' . csrf_field() . '
                        ' . method_field('delete') . '
                        <button class="" style="color: rgb(209, 3, 3);">
                            <i class="far fa-trash-alt"></i>
                        </button>
                        </form>
                    </td> ';
                    return $actionBtn;
                })
                ->rawColumns(['comprobante', 'action'])
                ->make(true);
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Gasto  $gasto
     * @return \Illuminate\Http\Response
     */
    public function show(Gasto $gasto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Gasto  $gasto
     * @return \Illuminate\Http\Response
     */
    public function edit(Gasto $gasto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Gasto  $gasto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gasto $gasto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Gasto  $gasto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gasto $gasto)
    {
        //
    }
}
