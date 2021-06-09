<?php

namespace App\Http\Controllers;

use App\Models\Sucursal;
use App\Models\Zip;
use Illuminate\Http\Request;
use stdClass;

class ZipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function zipsSearch(Request $request)
    {
        //! TODO: invertir esos valores 
        //* country_code = 'MX', 'US', 'FR', 'CA';
        //*  postal_code = 51356, 
        //* place_name = direccion, 
        //* admin_name1 = Mexico, sinaloa (estados ) 
        //* code_name1 = abreviacion 3 letras estados,
        //* admin_name2 = Toluca, atlacomulco (municipio)
        //*   

        $zips = [];
        
        
        if ($request->has('search')) {
            
            $postalCode = $request->search;
            $countryCode = $request->countryCode;
            // $zips = Zip::select("id", "d_codigo", "d_asenta", "D_mnpio","d_estado")
            $zips = Zip::select("id", "country_code", "postal_code" , "place_name","admin_name1", "admin_name2")
                ->where('postal_code', 'LIKE', "%$postalCode%")
                ->where('country_code', 'LIKE', "%$countryCode%")
                ->limit(10)
                ->get();
        }
        return response()->json($zips);
        
    }

    public function getZips(Request $request)
    {
        if ($request->ajax()) {

            $data = new stdClass();
           
            $data->cp_remitente = Sucursal::where('id', $request->id_sucursal)->value('codigo_postal');
            // $data->cp_destinatario = Sepomex::where('id', $request->id_cp_destinatario)->value('d_codigo');
            $codigoSelect = Zip::select('id', 'postal_code')->where('id', 'LIKE', $request->id_cp_destinatario )->get();
            
            $data->cp_destinatario = $codigoSelect[0]->postal_code;
            $data->id_cp_destinatario = $codigoSelect[0]->id;

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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Zip  $zip
     * @return \Illuminate\Http\Response
     */
    public function show(Zip $zip)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Zip  $zip
     * @return \Illuminate\Http\Response
     */
    public function edit(Zip $zip)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Zip  $zip
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Zip $zip)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Zip  $zip
     * @return \Illuminate\Http\Response
     */
    public function destroy(Zip $zip)
    {
        //
    }
}
