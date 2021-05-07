<?php

namespace App\Http\Controllers;

use App\Models\TipoCliente;
use Illuminate\Http\Request;
use App\Http\Requests\TipoClienteStoreRequest;
use App\Http\Requests\TipoClienteUpdateRequest;

class TipoClienteController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', TipoCliente::class);

        $search = $request->get('search', '');

        $tipoClientes = TipoCliente::search($search)
            ->latest()
            ->paginate(5);

        return view(
            'app.tipo_clientes.index',
            compact('tipoClientes', 'search')
        );
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', TipoCliente::class);

        return view('app.tipo_clientes.create');
    }

    /**
     * @param \App\Http\Requests\TipoClienteStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(TipoClienteStoreRequest $request)
    {
        $this->authorize('create', TipoCliente::class);

        $validated = $request->validated();

        $tipoCliente = TipoCliente::create($validated);

        return redirect()
            ->route('tipo-clientes.edit', $tipoCliente)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\TipoCliente $tipoCliente
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, TipoCliente $tipoCliente)
    {
        $this->authorize('view', $tipoCliente);

        return view('app.tipo_clientes.show', compact('tipoCliente'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\TipoCliente $tipoCliente
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, TipoCliente $tipoCliente)
    {
        $this->authorize('update', $tipoCliente);

        return view('app.tipo_clientes.edit', compact('tipoCliente'));
    }

    /**
     * @param \App\Http\Requests\TipoClienteUpdateRequest $request
     * @param \App\Models\TipoCliente $tipoCliente
     * @return \Illuminate\Http\Response
     */
    public function update(
        TipoClienteUpdateRequest $request,
        TipoCliente $tipoCliente
    ) {
        $this->authorize('update', $tipoCliente);

        $validated = $request->validated();

        $tipoCliente->update($validated);

        return redirect()
            ->route('tipo-clientes.edit', $tipoCliente)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\TipoCliente $tipoCliente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, TipoCliente $tipoCliente)
    {
        $this->authorize('delete', $tipoCliente);

        $tipoCliente->delete();

        return redirect()
            ->route('tipo-clientes.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
