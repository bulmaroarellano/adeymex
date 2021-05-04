<?php

namespace App\Http\Controllers;

use App\Http\Requests\SucursalRequest;
use App\Models\Pais;
use App\Models\Sucursal;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;


class SucursalesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sucursales = Sucursal::orderBy('id', 'desc')->paginate(8);
        $paises = Pais::all()->pluck('pais', 'pais');

        return view('/paqueteria/catalogos/sucursales', [
            'sucursales' => $sucursales,
            'paises' => $paises,

        ]);
    }

    public function getSucursales(Request $request)
    {
        if ($request->ajax()) {
            $data = Sucursal::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($sucursal) {
                    $actionBtn = '
                    <td class="">
                    <form action=" ' . route('sucursales.destroy', $sucursal) . ' " method="POST" class = "d-flex justify-content-around">
                        <a href=" ' . route('sucursales.show', [$sucursal, '0']) . ' "> <i class="far fa-eye "></i> </a>
                        <a href=" ' . route('sucursales.show', [$sucursal, '1']) . ' "><i class="fas fa-pen-alt"></i> </a>
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
    public function store(SucursalRequest $request)
    {
        // return $request;
        Sucursal::create($request->all());
        return redirect()->route('sucursales.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Sucursal $sucursal, $edit)
    {
        $paises = Pais::all()->pluck('pais', 'pais');

        return redirect()->route('sucursales.index')->with([
            'values' => $sucursal,
            'paises' => $paises,
            'edit' => $edit
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Sucursal $sucursal)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SucursalRequest $request, Sucursal $sucursal)
    {
        $sucursal->update($request->all());
        return redirect()->route('sucursales.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sucursal $sucursal)
    {
        // return $sucursal;
        $sucursal->delete();
        return redirect()->route('sucursales.index');
    }
}
