<?php

namespace App\Http\Controllers;


use App\Http\Requests\UnidadStoreRequest;
use App\Http\Requests\UnidadUpdateRequest;
use App\Models\Unidad;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class UnidadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $unidadesMedida = Unidad::orderBy('id', 'desc')->paginate(8);
        return view('/paqueteria/catalogos/unidadesMedidas', [
            'unidadesMedida' => $unidadesMedida,
        ]);

    }

    public function getUnidades(Request $request)
    {
        if ($request->ajax()) {
            $data = Unidad::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($unidad) {
                    $actionBtn = '
                    <td class="">
                    <form action=" ' . route('unidades.destroy', $unidad) . ' " method="POST" class = "d-flex justify-content-around">
                        <a href=" ' . route('unidades.show', [$unidad, '0']) . ' "> <i class="far fa-eye "></i> </a>
                        <a href=" ' . route('unidades.show', [$unidad, '1']) . ' "><i class="fas fa-pen-alt"></i> </a>
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

    public function unidadesSearch(Request $request)
    {
    	$paises = [];

        if($request->has('q')){
            $search = $request->q;
            $paises = Unidad::select("id", "unidad_medida")
            		->where('unidad_medida', 'LIKE', "%$search%")->limit(5)
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
    public function store(UnidadStoreRequest $request)
    {
        Unidad::create($request->all());
        return redirect()->route('unidades.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Unidad  $unidadMedida
     * @return \Illuminate\Http\Response
     */
    public function show(Unidad $unidadMedida, $edit)
    {

        return redirect()->route('unidades.index' )->with([
            'values' => $unidadMedida,  
            'edit' => $edit
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UnidadMedida  $unidadMedida
     * @return \Illuminate\Http\Response
     */
    public function edit(Unidad $unidadMedida)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Unidad  $unidadMedida
     * @return \Illuminate\Http\Response
     */
    public function update(UnidadUpdateRequest $request, Unidad $unidadMedida)
    {
        $unidadMedida->update($request->all());
        return redirect()->route('unidades.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UnidadMedida  $unidadMedida
     * @return \Illuminate\Http\Response
     */
    public function destroy(Unidad $unidadMedida)
    {
        $unidadMedida->delete();
        return redirect()->route('unidades.index');
    }
}
