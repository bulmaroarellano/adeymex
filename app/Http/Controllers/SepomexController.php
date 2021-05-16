<?php

namespace App\Http\Controllers;

use App\Models\Sepomex;
use Illuminate\Http\Request;

class SepomexController extends Controller
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


    public function sepomexSearch(Request $request)
    {
        $codigos = [];
        if ($request->has('q')) {
            $search = $request->q;
            $codigos = Sepomex::select("id", "d_codigo", "d_asenta", "D_mnpio","d_estado")
                ->where('d_codigo', 'LIKE', "%$search%")->limit(5)
                ->get();
        }
        return response()->json($codigos);
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
     * @param  \App\Models\Sepomex  $sepomex
     * @return \Illuminate\Http\Response
     */
    public function show(Sepomex $sepomex)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sepomex  $sepomex
     * @return \Illuminate\Http\Response
     */
    public function edit(Sepomex $sepomex)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sepomex  $sepomex
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sepomex $sepomex)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sepomex  $sepomex
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sepomex $sepomex)
    {
        //
    }
}
