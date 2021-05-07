<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaisRequest;
use App\Http\Requests\PaisStoreRequest;
use App\Http\Requests\PaisUpdateRequest;
use App\Models\Moneda;
use App\Models\Pais;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PaisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paises = Pais::orderBy('id','desc')->paginate(8);
        $monedas = Moneda::all()->pluck('nombre', 'id');
       
        return view('/paqueteria/catalogos/paises', [
            'paises' => $paises,
            'monedas' => $monedas,
        ]);
    
    }

    public function getPaises(Request $request)
    {
        if ($request->ajax()) {
            $data = Pais::latest()->get();
            for ($i=0; $i < count($data); $i++) { 
                $data[$i]['moneda_id'] = Moneda::where('id', $data[$i]['moneda_id'])->get();
                
            }
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($pais) {
                    $actionBtn = '
                    <td class="">
                    <form action=" ' . route('paises.destroy', $pais) . ' " method="POST" class = "d-flex justify-content-around">
                        <a href=" ' . route('paises.show', [$pais, '0']) . ' "> <i class="far fa-eye "></i> </a>
                        <a href=" ' . route('paises.show', [$pais, '1']) . ' "><i class="fas fa-pen-alt"></i> </a>
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



    public function paisesSearch(Request $request)
    {
    	$paises = [];

        if($request->has('q')){
            $search = $request->q;
            $paises =Pais::select("id", "nombre")
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
    public function store(PaisStoreRequest $request)
    {
        Pais::create($request->all());
        return redirect()->route('paises.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pais  $pais
     * @return \Illuminate\Http\Response
     */
    public function show(Pais $pais, $edit)
    {
        return redirect()->route('paises.index' )->with([
            'values' => $pais,  
            'edit' => $edit
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pais  $pais
     * @return \Illuminate\Http\Response
     */
    public function edit(Pais $pais)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pais  $pais
     * @return \Illuminate\Http\Response
     */
    public function update(PaisUpdateRequest $request, Pais $pais)
    {
        
        $pais->update($request->all());
        return redirect()->route('paises.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pais  $pais
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pais $pais)
    {
        $pais->delete();
        return redirect()->route('paises.index');

    }
}
