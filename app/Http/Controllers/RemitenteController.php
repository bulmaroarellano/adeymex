<?php

namespace App\Http\Controllers;

use App\Http\Requests\RemitenteRequest;
use App\Http\Requests\RemitenteStoreRequest;
use App\Http\Requests\RemitenteUpdateRequest;
use App\Models\Cliente;
use App\Models\Empresa;
use App\Models\Pais;
use App\Models\Remitente;
use App\Models\Sucursal;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class RemitenteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $remitentes = Remitente::orderBy('id', 'desc')->paginate(8);
        $sucursalesName = Sucursal::all()->pluck('nombre', 'id');
        $paises = Pais::all()->pluck('nombre', 'id');
        $clientes = Cliente::all()->pluck('nombre', 'id');
        $empresas = Empresa::all()->pluck('nombre', 'id');
        return view('/paqueteria/catalogos/remitentes', [
            'remitentes' => $remitentes,
            'paises' => $paises, 
            'clientes' => $clientes, 
            'empresas' => $empresas, 
            'sucursalesName' => $sucursalesName, 
            
        ]);
        
    }

    public function getRemitentes(Request $request)
    {
        if ($request->ajax()) {
            $data = Remitente::latest()->get();
            for ($i=0; $i < count($data); $i++) { 
                $data[$i]['cliente_id'] = Cliente::where('id', $data[$i]['cliente_id'])->get();
                $data[$i]['empresa_id'] = Empresa::where('id', $data[$i]['empresa_id'])->get();
                $data[$i]['sucursal_id'] = Sucursal::where('id', $data[$i]['sucursal_id'])->get();
                $data[$i]['pais_id'] = Pais::where('id', $data[$i]['pais_id'])->get();
            }
           
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($remitente) {
                    $actionBtn = '
                    <td class="">
                    <form action=" ' . route('remitentes.destroy', $remitente) . ' " method="POST" class = "d-flex justify-content-around">
                        <a href=" ' . route('remitentes.show', [$remitente, '0']) . ' "> <i class="far fa-eye "></i> </a>
                        <a href=" ' . route('remitentes.show', [$remitente, '1']) . ' "><i class="fas fa-pen-alt"></i> </a>
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
    public function store(RemitenteStoreRequest $request)
    {

        Remitente::create($request->all());

        return redirect()->route('remitentes.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Remitente $remitente, $edit )
    {

        

        return redirect()->route('remitentes.index' )->with([
            'values' => $remitente, 
           
            'edit' => $edit
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RemitenteUpdateRequest $request, Remitente $remitente)
    {
     
        $remitente->update($request->all());
        return redirect()->route('remitentes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Remitente $remitente)
    {
        $remitente->delete();
        return redirect()->route('remitentes.index');

    }
}
