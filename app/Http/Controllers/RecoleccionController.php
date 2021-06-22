<?php

namespace App\Http\Controllers;

use App\Models\Recoleccion;
use App\Models\Sucursal;
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
        //
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
