<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use App\Http\Requests\ClienteStoreRequest;
use App\Http\Requests\ClienteUpdateRequest;

class ClienteController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Cliente::class);

        $search = $request->get('search', '');

        $clientes = Cliente::search($search)
            ->latest()
            ->paginate(5);

        return view('app.clientes.index', compact('clientes', 'search'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Cliente::class);

        return view('app.clientes.create');
    }

    /**
     * @param \App\Http\Requests\ClienteStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClienteStoreRequest $request)
    {
        $this->authorize('create', Cliente::class);

        $validated = $request->validated();

        $cliente = Cliente::create($validated);

        return redirect()
            ->route('clientes.edit', $cliente)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Cliente $cliente
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Cliente $cliente)
    {
        $this->authorize('view', $cliente);

        return view('app.clientes.show', compact('cliente'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Cliente $cliente
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Cliente $cliente)
    {
        $this->authorize('update', $cliente);

        return view('app.clientes.edit', compact('cliente'));
    }

    /**
     * @param \App\Http\Requests\ClienteUpdateRequest $request
     * @param \App\Models\Cliente $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(ClienteUpdateRequest $request, Cliente $cliente)
    {
        $this->authorize('update', $cliente);

        $validated = $request->validated();

        $cliente->update($validated);

        return redirect()
            ->route('clientes.edit', $cliente)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Cliente $cliente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Cliente $cliente)
    {
        $this->authorize('delete', $cliente);

        $cliente->delete();

        return redirect()
            ->route('clientes.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
