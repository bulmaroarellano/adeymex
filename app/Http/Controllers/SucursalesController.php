<?php

namespace App\Http\Controllers;

use App\Http\Requests\SucursalRequest;
use App\Http\Requests\SucursalStoreRequest;
use App\Http\Requests\SucursalUpdateRequest;
use App\Models\Encargado;
use App\Models\Pais;
use App\Models\Sucursal;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;


class SucursalesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $this->authorize('view-any', Sucursal::class);


        $sucursales = Sucursal::orderBy('id', 'desc')->paginate(8);
        $paises = Pais::all()->pluck('nombre', 'id');
        $encargados = Encargado::all()->pluck('nombre', 'id');


        return view('/paqueteria/catalogos/sucursales', [
            'sucursales' => $sucursales,
            'paises' => $paises,
            'encargados' => $encargados,

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
    
    public function findSucursal(Request $request)
    {
        if ($request->ajax()) {

            $data = Sucursal::where('id', $request->id)->first();

            return response()->json($data);
        }
    }

    public function sucursalesSearch(Request $request)
    {
        $paises = [];

        if ($request->has('q')) {
            $search = $request->q;
            $paises = Sucursal::select("id", "nombre")
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
    public function store(SucursalStoreRequest $request)
    {
        $this->authorize('create', Sucursal::class);

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
        $this->authorize('view', $sucursal);

        return redirect()->route('sucursales.index')->with([
            'values' => $sucursal,

            'edit' => $edit
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
/
*
 Update the specified resource in storage.

     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SucursalUpdateRequest $request, Sucursal $sucursal)
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
