<?php

namespace App\Http\Controllers;

use App\Http\Requests\DestinatarioRequest;
use App\Http\Requests\DestinatarioStoreRequest;
use App\Http\Requests\DestinatarioUpdateRequest;
use App\Models\Destinatario;
use App\Models\Empresa;
use App\Models\Pais;
use App\Models\Sucursal;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class DestinatarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $destinatarios = Destinatario::orderBy('id', 'desc')->paginate(8);
        $sucursalesName = Sucursal::all()->pluck('nombre', 'id');
        $paises = Pais::all()->pluck('nombre', 'id');
        $empresas = Empresa::all()->pluck('nombre', 'id');
        return view('/paqueteria/catalogos/destinatarios', [
            'destinatarios' => $destinatarios,
            'paises' => $paises, 
            'empresas' => $empresas, 
            'sucursalesName' => $sucursalesName,

        ]);
    }

    public function getDestinatarios(Request $request)
    {
        if ($request->ajax()) {
            $data = Destinatario::latest()->get();
            for ($i=0; $i < count($data); $i++) { 
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
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DestinatarioStoreRequest $request)
    {
   
        Destinatario::create($request->all());
        return redirect()->route('destinatarios.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Destinatario $destinatario, $edit)
    {
        //TODO : checar cuando enviar los nombre de las sucursales 

        return redirect()->route('destinatarios.index')->with([
            'values' => $destinatario,

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
    public function update(DestinatarioUpdateRequest $request, Destinatario $destinatario)
    {
        $destinatario->update($request->all());
        return redirect()->route('destinatarios.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Destinatario $destinatario)
    {
        $destinatario->delete();
        return redirect()->route('destinatarios.index');
    }
}
