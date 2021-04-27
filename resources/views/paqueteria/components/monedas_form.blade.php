{{-- +  MODAL CREATE --}}
<div class="container sucursales-form">
    <div class="row d-flex justify-content-center">
        <div class="col-md-12 ">
            <form 
                action="{{ session()->get('edit') == 1 ? route('monedas.update', session()->get('values') ?? '') : route('monedas.store') }}"
                method="POST"
            >

                @csrf
                @if (session()->get('edit') == 1)

                    @method('put')

                @endif

                <div class="col-md-12">

                    <div class="row justify-content-center">
                        <!-- + Domicilio-->
                        <div class="col-md-6 ">
                            <div class="card sucursales-form__card h-100">
                                <div class="card-header text-center">Monedas</div>
                                <div class="card-body d-flex flex-column justify-content-around">

                                    <div class="form-group row mt-2">
                                        <div class="col-sm-5">
                                            <i class="fas fa-money-bill-wave-alt"></i>
                                            <label class="col-form-label ml-1">Moneda</label>
                                        </div>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control" name="moneda"
                                                placeholder="dollar,peso mexicano"
                                                value="{{ session()->get('values')->moneda ?? '' }}"
                                                {{ session()->has('edit') && session()->get('edit') == 0 ? 'readonly' : '' }}>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-sm-5">
                                            <i class="fas fa-coins"></i>
                                            <label class="col-form-label ml-1">Codigo</label>
                                        </div>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control" name="codigo"
                                                placeholder="USD, MXN"
                                                value="{{ session()->get('values')->codigo ?? '' }}"
                                                {{ session()->has('edit') && session()->get('edit') == 0 ? 'readonly' : '' }}>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-sm-5">
                                            <i class="fas fa-dollar-sign"></i>
                                            <label class="col-form-label ml-1">Simbolo<label>
                                        </div>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control" name="simbolo"
                                                placeholder=""
                                                value="{{ session()->get('values')->simbolo ?? '' }}"
                                                {{ session()->has('edit') && session()->get('edit') == 0 ? 'readonly' : '' }}>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="row d-flex justify-content-center">
                    <div class="col-md-6">
                        <div class="row d-flex justify-content-sm-around mt-2">

                            <button class="btn btn-secondary" type="submit">
                                {{ session()->get('edit') ? 'Actualizar' : 'Crear' }}
                            </button>

                            <button class="btn btn-danger" type="submit">
                                <i class="fas fa-ban mr-1"></i>
                                Cancelar
                            </button>

                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>
{{-- +  MODAL FIN CREATE --}}
