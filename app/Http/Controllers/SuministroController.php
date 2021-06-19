<?php

namespace App\Http\Controllers;

use App\Http\Requests\SuministroRequest;
use App\Http\Requests\SuministroStoreRequest;
use App\Http\Requests\SuministroUpdateRequest;
use App\Models\Sucursal;
use App\Models\Suministro;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SuministroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suministros = Suministro::orderBy('id', 'desc')->paginate(8);
        $sucursalesName = Sucursal::all()->pluck('nombre', 'id');
        return view('/paqueteria/catalogos/suministros', [
            'suministros' => $suministros, 
            'sucursalesName' => $sucursalesName, 
        ]);
    }

    public function getSuministros(Request $request)
    {
        if ($request->ajax()) {
            $data = Suministro::latest()->get();
            for ($i=0; $i < count($data); $i++) { 
    
                $data[$i]['sucursal_id'] = Sucursal::where('id', $data[$i]['sucursal_id'])->get();            
            }
           
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($suministro) {
                    $actionBtn = '
                    <td class="">
                    <form action=" ' . route('suministros.destroy', $suministro) . ' " method="POST" class = "d-flex justify-content-around">
                        <a href=" ' . route('suministros.show', [$suministro, '0']) . ' "> <i class="far fa-eye "></i> </a>
                        <a href=" ' . route('suministros.show', [$suministro, '1']) . ' "><i class="fas fa-pen-alt"></i> </a>
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

    public function suministrosSearch(Request $request)
    {
        $suministros = [];

        if ($request->has('q')) {
            
            $search = $request->q;
            $suministros = Suministro::select("id", "nombre", "precio_publico")
                ->where('nombre', 'LIKE', "%$search%")->limit(5)
                ->get();
        }
        return response()->json($suministros);
        
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
    public function store(SuministroStoreRequest $request)
    {
        Suministro::create($request->all());
        return redirect()->route('suministros.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Suministro  $suministro
     * @return \Illuminate\Http\Response
     */
    public function show(Suministro $suministro, $edit)
    {
        
        return redirect()->route('suministros.index' )->with([
            'values' => $suministro, 
            'edit' => $edit
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Suministro  $suministro
     * @return \Illuminate\Http\Response
     */
    public function edit(Suministro $suministro)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Suministro  $suministro
     * @return \Illuminate\Http\Response
     */
    public function update(SuministroUpdateRequest $request, Suministro $suministro)
    {
        $suministro->update($request->all());
        return redirect()->route('suministros.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Suministro  $suministro
     * @return \Illuminate\Http\Response
     */
    public function destroy(Suministro $suministro)
    {
        $suministro->delete();
        return redirect()->route('suministros.index');

    }
}
