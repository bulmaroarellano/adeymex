<?php

namespace App\Http\Controllers;

use App\Http\Requests\MonedaRequest;
use App\Http\Requests\MonedaStoreRequest;
use App\Http\Requests\MonedaUpdateRequest;
use App\Models\Moneda;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class MonedaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $monedas = Moneda::orderBy('id', 'desc')->paginate(8);

        return view('/paqueteria/catalogos/monedas', [
            'monedas' => $monedas,
        ]);
    }

    public function getMonedas(Request $request)
    {
        if ($request->ajax()) {
            $data = Moneda::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($moneda) {
                    $actionBtn = '
                    <td class="">
                    <form action=" ' . route('monedas.destroy', $moneda) . ' " method="POST" class = "d-flex justify-content-around">
                        <a href=" ' . route('monedas.show', [$moneda, '0']) . ' "> <i class="far fa-eye "></i> </a>
                        <a href=" ' . route('monedas.show', [$moneda, '1']) . ' "><i class="fas fa-pen-alt"></i> </a>
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

    public function monedasSearch(Request $request)
    {
    	$paises = [];

        if($request->has('q')){
            $search = $request->q;
            $paises = Moneda::select("id", "nombre")
            		->where('nombre', 'LIKE', "%$search%")->limit(5)
            		->get();
        }
        return response()->json($paises);
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
    public function store(MonedaStoreRequest $request)
    {
        Moneda::create($request->all());

        return redirect()->route('monedas.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Moneda  $moneda
     * @return \Illuminate\Http\Response
     */
    public function show(Moneda $moneda, $edit)
    {

        return redirect()->route('monedas.index' )->with([
            'values' => $moneda,  
            'edit' => $edit
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Moneda  $moneda
     * @return \Illuminate\Http\Response
     */
    public function edit(Moneda $moneda)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Moneda  $moneda
     * @return \Illuminate\Http\Response
     */
    public function update(MonedaUpdateRequest $request, Moneda $moneda)
    {
        $moneda->update($request->all());
        return redirect()->route('monedas.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Moneda  $moneda
     * @return \Illuminate\Http\Response
     */
    public function destroy(Moneda $moneda)
    {
        $moneda->delete();
        return redirect()->route('monedas.index');

    }
}
