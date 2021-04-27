{{-- +  MODAL CREATE --}}
<div class="container sucursales-form">
    <div class="row d-flex justify-content-center">
        <div class="col-md-12 ">
            <form 
                action="{{ session()->get('edit') == 1 ? route('mercancias.update', session()->get('values') ?? '') : route('mercancias.store') }}"
            
        method="POST">

                @csrf
                @if (session()->get('edit') == 1)

                    @method('put')

                @endif

                <div class="col-md-12">

                    <div class="row justify-content-between">

                        <!-- + Datos generales-->
                        <div class="col-md-6">
                            <div class="card sucursales-form__card h-100">
                                <div class="card-header">Datos generales</div>
                                <div class="card-body d-flex flex-column justify-content-around mt-1">

                                    <div class="form-group row">
                                        <div class="col-sm-5">
                                            <i class="far fa-user"></i>
                                            <label class="col-form-label ml-1">Producto</label>
                                        </div>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control" name="producto" placeholder=""
                                                value="{{ session()->get('values')->producto ?? '' }}"
                                                {{ session()->has('edit') && session()->get('edit') == 0 ? 'readonly' : '' }}>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-sm-5">
                                            <i class="far fa-user"></i>
                                            <label class="col-form-label ml-1">Producto Ingles</label>
                                        </div>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control" name="productoIngles" placeholder=""
                                                value="{{ session()->get('values')->productoIngles ?? '' }}"
                                                {{ session()->has('edit') && session()->get('edit') == 0 ? 'readonly' : '' }}>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-sm-5">
                                            <i class="far fa-user"></i>
                                            <label class="col-form-label ml-1">Clave</label>
                                        </div>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control" name="claveInternacional" placeholder=""
                                                value="{{ session()->get('values')->claveInternacional ?? '' }}"
                                                {{ session()->has('edit') && session()->get('edit') == 0 ? 'readonly' : '' }}>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-sm-5">
                                            <i class="fas fa-building"></i>
                                            <label class="col-form-label ml-1">Costo</label>
                                        </div>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control" name="costo" placeholder=""
                                                value="{{ session()->get('values')->costo ?? '' }}"
                                                {{ session()->has('edit') && session()->get('edit') == 0 ? 'readonly' : '' }}>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-sm-5">
                                            <i class="fas fa-store"></i>
                                            <label class="col-form-label ml-1">
                                                Moneda
                                            </label>
                                        </div>
                                        <div class="col-sm-7">
                                            <select class="form-control" name="moneda"
                                                {{ session()->has('edit') && session()->get('edit') == 0 ? 'readonly' : '' }}>
                                                <option>{{ session()->get('values')->moneda ?? '' }}</option>

                                                @if (session()->get('monedas'))
                                                    @foreach (session()->get('monedas') as $moneda)
                                                        @if ($moneda !== session()->get('values')->moneda)

                                                            <option>{{ $moneda }}</option>
                                                        @endif
                                                    @endforeach
                                                @else
                                                    @foreach ($monedas as $moneda)


                                                        <option>{{ $moneda }}</option>

                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <!-- + Mercancia 2-->
                        <div class="col-md-6 ">
                            <div class="card sucursales-form__card h-100">
                                <div class="card-header text-center">Paquete</div>
                                <div class="card-body d-flex flex-column justify-content-around">

                                    <div class="form-group row">
                                        <div class="col-sm-5">
                                            <i class="fas fa-house-user"></i>
                                            <label class="col-form-label ml-1">Media</label>
                                        </div>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control" name="medida"
                                                placeholder="Domicilio 1"
                                                value="{{ session()->get('values')->medida ?? '' }}"
                                                {{ session()->has('edit') && session()->get('edit') == 0 ? 'readonly' : '' }}>
                                        </div>
                                    </div>
                                    {{-- UNIDAD DE MEDIDA  --}}
                                    <div class="form-group row">
                                        <div class="col-sm-5">
                                            <i class="fas fa-store"></i>
                                            <label class="col-form-label ml-1">
                                                Unidad de medida
                                            </label>
                                        </div>
                                        <div class="col-sm-7">
                                            <select class="form-control" name="unidadMedida"
                                                {{ session()->has('edit') && session()->get('edit') == 0 ? 'readonly' : '' }}>
                                                <option>{{ session()->get('values')->unidadMedida ?? '' }}</option>

                                                @if (session()->get('unidadMedidas'))
                                                    @foreach (session()->get('unidadMedidas') as $unidadMedida)
                                                        @if ($unidadMedida !== session()->get('values')->unidadMedida)

                                                            <option>{{ $unidadMedida }}</option>
                                                        @endif
                                                    @endforeach
                                                @else
                                                    @foreach ($unidadMedidas as $unidadMedida)


                                                        <option>{{ $unidadMedida }}</option>

                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    {{-- PAISES  --}}
                                    <div class="form-group row">
                                        <div class="col-sm-5">
                                            <i class="fas fa-store"></i>
                                            <label class="col-form-label ml-1">
                                                Pais
                                            </label>
                                        </div>
                                        <div class="col-sm-7">
                                            <select class="form-control" name="pais"
                                                {{ session()->has('edit') && session()->get('edit') == 0 ? 'readonly' : '' }}>
                                                <option>{{ session()->get('values')->pais ?? '' }}</option>

                                                @if (session()->get('paises'))
                                                    @foreach (session()->get('paises') as $pais)
                                                        @if ($pais !== session()->get('values')->pais)

                                                            <option>{{ $pais }}</option>
                                                        @endif
                                                    @endforeach
                                                @else
                                                    @foreach ($paises as $pais)


                                                        <option>{{ $pais }}</option>

                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-sm-5">
                                            <i class="fas fa-house-user"></i>
                                            <label class="col-form-label ml-1">Peso [Kg]</label>
                                        </div>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control" name="peso"
                                                placeholder=""
                                                value="{{ session()->get('values')->peso ?? '' }}"
                                                {{ session()->has('edit') && session()->get('edit') == 0 ? 'readonly' : '' }}>
                                        </div>
                                    </div>

                                    

                                    

                                </div>
                            </div>
                        </div>

                    </div>

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
            </form>
        </div>
    </div>

</div>
{{-- +  MODAL FIN CREATE --}}
