<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use Illuminate\Http\Request;
use App\Http\Requests\EmpresaStoreRequest;
use App\Http\Requests\EmpresaUpdateRequest;

class EmpresaController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Empresa::class);

        $search = $request->get('search', '');

        $empresas = Empresa::search($search)
            ->latest()
            ->paginate(5);

        return view('app.empresas.index', compact('empresas', 'search'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Empresa::class);

        return view('app.empresas.create');
    }

    /**
     * @param \App\Http\Requests\EmpresaStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmpresaStoreRequest $request)
    {
        $this->authorize('create', Empresa::class);

        $validated = $request->validated();

        $empresa = Empresa::create($validated);

        return redirect()
            ->route('empresas.edit', $empresa)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Empresa $empresa
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Empresa $empresa)
    {
        $this->authorize('view', $empresa);

        return view('app.empresas.show', compact('empresa'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Empresa $empresa
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Empresa $empresa)
    {
        $this->authorize('update', $empresa);

        return view('app.empresas.edit', compact('empresa'));
    }

    /**
     * @param \App\Http\Requests\EmpresaUpdateRequest $request
     * @param \App\Models\Empresa $empresa
     * @return \Illuminate\Http\Response
     */
    public function update(EmpresaUpdateRequest $request, Empresa $empresa)
    {
        $this->authorize('update', $empresa);

        $validated = $request->validated();

        $empresa->update($validated);

        return redirect()
            ->route('empresas.edit', $empresa)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Empresa $empresa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Empresa $empresa)
    {
        $this->authorize('delete', $empresa);

        $empresa->delete();

        return redirect()
            ->route('empresas.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
