{{-- +  MODAL CREATE --}}
<div class="container sucursales-form">
    <div class="row d-flex justify-content-center">
        <div class="col-md-12 ">
            <form  
            action="{{ session()->get('edit') == 1 ? route('suministros.update', session()->get('values') ?? '') : route('suministros.store') }}"
                method="POST"
            >

                @csrf
                @if (session()->get('edit') == 1)

                    @method('put')

                @endif

                <div class="col-md-12">

                    <div class="row justify-content-center">
                        <!-- + suministros -->
                        <div class="col-md-6">
                            <div class="card sucursales-form__card h-100">
                                <div class="card-header text-center">Suministro</div>
                                <div class="card-body d-flex flex-column justify-content-around">

                                    <div class="form-group row mt-2">
                                        <div class="col-sm-5">
                                            <i class="fas fa-store"></i>
                                            <label class="col-form-label ml-1">
                                                Sucursal
                                            </label>
                                        </div>
                                        <div class="col-sm-7">
                                            <select class="form-control" name="sucursal"
                                                {{ session()->has('edit') && session()->get('edit') == 0 ? 'readonly' : '' }}>
                                                <option>{{ session()->get('values')->sucursal ?? '' }}</option>

                                                @if (session()->get('sucursalesName'))
                                                    @foreach (session()->get('sucursalesName') as $sucursalName)
                                                        @if ($sucursalName !== session()->get('values')->sucursal)

                                                            <option>{{ $sucursalName }}</option>
                                                        @endif
                                                    @endforeach
                                                @else
                                                    @foreach ($sucursalesName as $sucursalName)


                                                        <option>{{ $sucursalName }}</option>

                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-sm-5">
                                            <i class="fas fa-house-user"></i>
                                            <label class="col-form-label ml-1">Producto</label>
                                        </div>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control" name="producto"
                                                placeholder=""
                                                value="{{ session()->get('values')->producto ?? '' }}"
                                                {{ session()->has('edit') && session()->get('edit') == 0 ? 'readonly' : '' }}>
                                        </div>
                                    </div>

                                    <div class="form-group row ">
                                        <div class="col-sm-5">
                                            <i class="fas fa-house-user"></i>
                                            <label class="col-form-label ml-1">Costo<label>
                                        </div>
                                        <div class="col-sm-7 has-feedback">
                                            <div class="input-group">
                                                <input type="number" class="form-control" name="costo"
                                                    placeholder=""
                                                    value="{{ session()->get('values')->costo ?? '' }}"
                                                    {{ session()->has('edit') && session()->get('edit') == 0 ? 'readonly' : '' }}>
                                                <div class="input-group-append">
                                                    <span class="input-group-text">MXN</span>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-5">
                                            <i class="fas fa-house-user"></i>
                                            <label class="col-form-label ml-1">Precio Publico<label>
                                        </div>
                                        <div class="col-sm-7">
                                            <div class="input-group">
                                                <input type="number" class="form-control" name="precioPublico"
                                                    placeholder=""
                                                    value="{{ session()->get('values')->precioPublico ?? '' }}"
                                                    {{ session()->has('edit') && session()->get('edit') == 0 ? 'readonly' : '' }}>
                                                <div class="input-group-append">
                                                    <span class="input-group-text">MXN</span>
                                                </div>
                                            </div>
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
