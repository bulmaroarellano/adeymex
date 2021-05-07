<?php

namespace App\Http\Controllers;

use App\Models\Pais;
use App\Models\Sucursal;
use Illuminate\Http\Request;
use App\Http\Requests\SucursalStoreRequest;
use App\Http\Requests\SucursalUpdateRequest;

class SucursalController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Sucursal::class);

        $search = $request->get('search', '');

        $sucursales = Sucursal::search($search)
            ->latest()
            ->paginate(5);

        return view('app.sucursales.index', compact('sucursales', 'search'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Sucursal::class);

        $paises = Pais::pluck('nombre', 'id');

        return view('app.sucursales.create', compact('paises'));
    }

    /**
     * @param \App\Http\Requests\SucursalStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(SucursalStoreRequest $request)
    {
        $this->authorize('create', Sucursal::class);

        $validated = $request->validated();

        $sucursal = Sucursal::create($validated);

        return redirect()
            ->route('sucursales.edit', $sucursal)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Sucursal $sucursal
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Sucursal $sucursal)
    {
        $this->authorize('view', $sucursal);

        return view('app.sucursales.show', compact('sucursal'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Sucursal $sucursal
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Sucursal $sucursal)
    {
        $this->authorize('update', $sucursal);

        $paises = Pais::pluck('nombre', 'id');

        return view('app.sucursales.edit', compact('sucursal', 'paises'));
    }

    /**
     * @param \App\Http\Requests\SucursalUpdateRequest $request
     * @param \App\Models\Sucursal $sucursal
     * @return \Illuminate\Http\Response
     */
    public function update(SucursalUpdateRequest $request, Sucursal $sucursal)
    {
        $this->authorize('update', $sucursal);

        $validated = $request->validated();

        $sucursal->update($validated);

        return redirect()
            ->route('sucursales.edit', $sucursal)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Sucursal $sucursal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Sucursal $sucursal)
    {
        $this->authorize('delete', $sucursal);

        $sucursal->delete();

        return redirect()
            ->route('sucursales.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
