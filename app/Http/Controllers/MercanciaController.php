<?php

namespace App\Http\Controllers;

use App\Http\Requests\MercanciaRequest;
use App\Http\Requests\MercanciaStoreRequest;
use App\Http\Requests\MercanciaUpdateRequest;
use App\Models\Mercancia;
use App\Models\Moneda;
use App\Models\Pais;
use App\Models\Unidad;
use App\Models\UnidadMedida;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class MercanciaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mercancias = Mercancia::orderBy('id', 'desc')->paginate(8);

        $monedas = Moneda::all()->pluck('nombre', 'id');
        $unidadMedidas = Unidad::all()->pluck('unidad_medida', 'id');
        $paises = Pais::all()->pluck('nombre', 'id');

        return view('/paqueteria/catalogos/mercancias', [
            'mercancias' => $mercancias, 
            'monedas' => $monedas,
            'unidadMedidas' => $unidadMedidas,
            'paises' => $paises,
        ]);
    }

    public function getMercancias(Request $request)
    {
        if ($request->ajax()) {
            $data = Mercancia::latest()->get();
            for ($i=0; $i < count($data); $i++) { 
                
                $data[$i]['pais_id']   = Pais::where('id', $data[$i]['pais_id'])->get();
                $data[$i]['moneda_id'] = Moneda::where('id', $data[$i]['moneda_id'])->get();
                $data[$i]['unidad_id'] = Unidad::where('id', $data[$i]['unidad_id'])->get();
            }
           
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($mercancia) {
                    $actionBtn = '
                    <td class="">
                    <form action=" ' . route('mercancias.destroy', $mercancia) . ' " method="POST" class = "d-flex justify-content-around">
                        <a href=" ' . route('mercancias.show', [$mercancia, '0']) . ' "> <i class="far fa-eye "></i> </a>
                        <a href=" ' . route('mercancias.show', [$mercancia, '1']) . ' "><i class="fas fa-pen-alt"></i> </a>
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
    public function store(MercanciaStoreRequest $request)
    {
        Mercancia::create($request->all());
        return redirect()->route('mercancias.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mercancia  $mercancia
     * @return \Illuminate\Http\Response
     */
    public function show(Mercancia $mercancia, $edit)

    {
        return redirect()->route('mercancias.index' )->with([
            'values' => $mercancia,  
            'edit' => $edit
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mercancia  $mercancia
     * @return \Illuminate\Http\Response
     */
    public function edit(Mercancia $mercancia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Mercancia  $mercancia
     * @return \Illuminate\Http\Response
     */
    public function update(MercanciaUpdateRequest $request, Mercancia $mercancia)
    {
        $mercancia->update($request->all());
        return redirect()->route('mercancias.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mercancia  $mercancia
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mercancia $mercancia)
    {
        $mercancia->delete();
        return redirect()->route('mercancias.index');
    }
}
