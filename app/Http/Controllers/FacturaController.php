<?php

namespace App\Http\Controllers;

use App\Models\Factura;
use App\Models\Nota;
use Illuminate\Http\Request;
use stdClass;
use Yajra\DataTables\Facades\DataTables;

class FacturaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return 'hola';
        return view('/paqueteria/envios/facturas/index');
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

    public function getFacturas(Request $request)
    {
        if ($request->ajax()) {
            $data  = Factura::get();

            return Datatables::of($data)
                ->addColumn('action', function ($fac) {

                    $badges = '    
                        <a href=" ' . route('fac.show', $fac) . ' "> <i class="far fa-eye "></i> </a>
                
                    ';
                    return $badges;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
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

        $file = $request->file('factura');

        $lines = explode("\n", $file->getContent());
        $headers = str_getcsv(array_shift($lines));
        $data = array();
        
        foreach ($lines as $line) {
            $row = array();
            foreach (str_getcsv($line) as $key => $field) {
                $key = trim($key);
                $row[$headers[$key]] = $field;
            }
            $row = array_filter($row);

            $data[] = $row;
        }

        // return ;

        $facturaValues = array();
        $fecha = date_format(date_create($data[0]['Fecha de origen']), 'Y-m-d');

        $facturaValues['paqueteria'] = $request->paqueteria;
        $facturaValues['folio'] = $data[0]['Número de factura'];
        $facturaValues['fecha'] = $fecha;
        $facturaValues['precio_total'] = $data[0]['Factura total adeudada'];

        $factura = Factura::create($facturaValues);
        
        foreach ($data as $key => $nota) {

            if ($key < count($data) - 1) {

                $guia = $nota['Número de guía aérea'];
                $precio = $nota['Monto total de la guía aérea'];

                $notaValues = array();
                $notaValues['factura_id'] = $factura->id;
                $notaValues['numero_guia'] = $guia;
                $notaValues['precio'] = $precio;

                Nota::create($notaValues);
            }
        }

        return view('/paqueteria/envios/facturas/index');
        
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Factura  $factura
     * @return \Illuminate\Http\Response
     */
    public function show(Factura $fac)
    {

        $notas = Nota::where('factura_id', $fac->id)->get();

        // return $notas;
        return view('/paqueteria/envios/facturas/show', [
            'notas' => $notas, 
            'factura' => $fac
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Factura  $factura
     * @return \Illuminate\Http\Response
     */
    public function edit(Factura $factura)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Factura  $factura
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Factura $factura)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Factura  $factura
     * @return \Illuminate\Http\Response
     */
    public function destroy(Factura $factura)
    {
        //
    }
}
