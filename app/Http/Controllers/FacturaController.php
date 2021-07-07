<?php

namespace App\Http\Controllers;

use App\Models\Factura;
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
                ->addColumn('action', function ($data) {
                   
                    $badges = '';
                   

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
        $xmlObject = simplexml_load_string($file->getContent());
        $ns = $xmlObject->getNamespaces(true);
        $facturaArray = $this->XMLNode($xmlObject, $ns);
        
        $factura = array();
        $factura['precio_base'] = $facturaArray['Conceptos']['Concepto']['Impuestos']['Traslados']['Traslado']['Base'];
        $factura['iva'] = $facturaArray['Conceptos']['Concepto']['Impuestos']['Traslados']['Traslado']['Importe'];
        $factura['total'] = $facturaArray['Total'];
        $factura['claveProd'] = $facturaArray['Conceptos']['Concepto']['ClaveProdServ'];
        $factura['folio'] = "{$facturaArray['Serie']} {$facturaArray['Folio']}" ;
        $factura['unidad'] = $facturaArray['Conceptos']['Concepto']['Unidad'];
        $factura['fecha'] = $facturaArray['Fecha'];
        $factura['descripcion'] = $facturaArray['Conceptos']['Concepto']['Descripcion'];
        $factura['paqueteria'] = 'FEDEX';
        
        Factura::create($factura);
        
        return view('/paqueteria/envios/facturas/index');
    }

    function XMLNode($XMLNode, $ns)
    {
        $nodes = array();
        $response = array();
        $attributes = array();
        $_isfirst = true;

        foreach ($ns as $eachSpace) {
            
            foreach ($XMLNode->children($eachSpace) as $_tag => $_node) {
                //
                $_value = $this->XMLNode($_node, $ns);
                if (key_exists($_tag, $nodes)) {
                    if ($_isfirst) {
                        $tmp = $nodes[$_tag];
                        unset($nodes[$_tag]);
                        $nodes[] = $tmp;
                        $is_first = false;
                    }
                    $nodes[] = $_value;
                } else {
                    $nodes[$_tag] = $_value;
                }
            }
        }

        $attributes = array_merge(
            $attributes,
            (array)current($XMLNode->attributes())
        );

        if (count($nodes)) {
            $response = array_merge(
                $response,
                $nodes
            );
        }

        // attributes ?
        if (count($attributes)) {
            $response = array_merge(
                $response,
                $attributes
            );
        }

        return (empty($response) ? null : $response);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Factura  $factura
     * @return \Illuminate\Http\Response
     */
    public function show(Factura $factura)
    {
        //
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
