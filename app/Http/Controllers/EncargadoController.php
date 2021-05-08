<?php

namespace App\Http\Controllers;

use App\Models\Sucursal;
use App\Models\Encargado;
use Illuminate\Http\Request;
use App\Http\Requests\EncargadoStoreRequest;
use App\Http\Requests\EncargadoUpdateRequest;

class EncargadoController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Encargado::class);

        $search = $request->get('search', '');

        $encargados = Encargado::search($search)
            ->latest()
            ->paginate(5);

        return view('app.encargados.index', compact('encargados', 'search'));
    }

    public function encargadosSearch(Request $request)
    {
    	$encargados = [];

        if($request->has('q')){
            $search = $request->q;
            $encargados = Encargado::select("id", "nombre")
            		->where('nombre', 'LIKE', "%$search%")->limit(5)
            		->get();
        }
        return response()->json($encargados);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Encargado::class);

        $sucursales = Sucursal::pluck('nombre', 'id');

        return view('app.encargados.create', compact('sucursales'));
    }

    /**
     * @param \App\Http\Requests\EncargadoStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(EncargadoStoreRequest $request)
    {
        $this->authorize('create', Encargado::class);

        $validated = $request->validated();

        $encargado = Encargado::create($validated);

        return redirect()
            ->route('encargados.edit', $encargado)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Encargado $encargado
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Encargado $encargado)
    {
        $this->authorize('view', $encargado);

        return view('app.encargados.show', compact('encargado'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Encargado $encargado
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Encargado $encargado)
    {
        $this->authorize('update', $encargado);

        $sucursales = Sucursal::pluck('nombre', 'id');

        return view('app.encargados.edit', compact('encargado', 'sucursales'));
    }

    /**
     * @param \App\Http\Requests\EncargadoUpdateRequest $request
     * @param \App\Models\Encargado $encargado
     * @return \Illuminate\Http\Response
     */
    public function update(
        EncargadoUpdateRequest $request,
        Encargado $encargado
    ) {
        $this->authorize('update', $encargado);

        $validated = $request->validated();

        $encargado->update($validated);

        return redirect()
            ->route('encargados.edit', $encargado)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Encargado $encargado
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Encargado $encargado)
    {
        $this->authorize('delete', $encargado);

        $encargado->delete();

        return redirect()
            ->route('encargados.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
