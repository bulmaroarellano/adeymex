<?php

namespace App\Http\Controllers;

use App\Http\Requests\CodigoPostalStoreRequest;
use App\Http\Requests\CodigoPostalUpdateRequest;
use App\Models\CodigoPostal;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CodigoPostalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $codigosPostales = CodigoPostal::orderBY('id', 'desc')->paginate(8);
    
        return view('/paqueteria/catalogos/codigosPostales', [
            'codigosPostales' => $codigosPostales,
        ]);
    }

    public function getCodigosPostales(Request $request)
    {
        if ($request->ajax()) {
            $data = CodigoPostal::latest()->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($codigoPostal) {
                    $actionBtn = '
                    <td class="">
                    <form action=" ' . route('codigosPostales.destroy', $codigoPostal) . ' " method="POST" class = "d-flex justify-content-around">
                        <a href=" ' . route('codigosPostales.show', [$codigoPostal, '0']) . ' "> <i class="far fa-eye "></i> </a>
                        <a href=" ' . route('codigosPostales.show', [$codigoPostal, '1']) . ' "><i class="fas fa-pen-alt"></i> </a>
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
    public function store(CodigoPostalStoreRequest $request)
    {
        CodigoPostal::create($request->all());

        return redirect()->route('codigosPostales.index');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CodigoPostal  $codigoPostal
     * @return \Illuminate\Http\Response
     */
    public function show(CodigoPostal $codigoPostal, $edit)
    {
        return redirect()->route('codigosPostales.index' )->with([
            'values' => $codigoPostal,  
            'edit' => $edit
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CodigoPostal  $codigoPostal
     * @return \Illuminate\Http\Response
     */
    public function edit(CodigoPostal $codigoPostal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CodigoPostal  $codigoPostal
     * @return \Illuminate\Http\Response
     */
    public function update(CodigoPostalUpdateRequest $request, CodigoPostal $codigoPostal)
    {
        $codigoPostal->update($request->all());
        return redirect()->route('codigosPostales.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CodigoPostal  $codigoPostal
     * @return \Illuminate\Http\Response
     */
    public function destroy(CodigoPostal $codigoPostal)
    {
        $codigoPostal->delete();
        return redirect()->route('codigosPostales.index');
    }
}
