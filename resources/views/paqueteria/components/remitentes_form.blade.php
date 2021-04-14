{{-- +  MODAL CREATE --}}
<div class="container sucursales-form">
    <div class="row d-flex justify-content-center">
        <div class="col-md-12 ">
            <form action="{{ session()->get('edit') == 1 
                    ? route('remitentes.update', session()->get('values') ?? '')
                    : route('remitentes.store') 
                    }}"
                    method="POST"
            >

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
                                    {{-- + TRAER LAS OPCIONES DEL MODELO SUCURSALES -->descripcion --}}
                                    <div class="form-group row">
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

                                                @endif
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-sm-5">
                                            <i class="far fa-user"></i>
                                            <label class="col-form-label ml-1">Nombre</label>
                                        </div>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control" name="nombre" placeholder=""
                                                value="{{ session()->get('values')->nombre ?? '' }}"
                                                {{ session()->has('edit') && session()->get('edit') == 0 ? 'readonly' : '' }}>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-sm-5">
                                            <i class="far fa-user"></i>
                                            <label class="col-form-label ml-1">Apellido Paterno</label>
                                        </div>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control" name="apellidoP" placeholder=""
                                                value="{{ session()->get('values')->apellidoP ?? '' }}"
                                                {{ session()->has('edit') && session()->get('edit') == 0 ? 'readonly' : '' }}>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-sm-5">
                                            <i class="far fa-user"></i>
                                            <label class="col-form-label ml-1">Apellido Materno</label>
                                        </div>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control" name="apellidoM" placeholder=""
                                                value="{{ session()->get('values')->apellidoM ?? '' }}"
                                                {{ session()->has('edit') && session()->get('edit') == 0 ? 'readonly' : '' }}>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-sm-5">
                                            <i class="fas fa-building"></i>
                                            <label class="col-form-label ml-1">Empresa</label>
                                        </div>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control" name="empresa" placeholder=""
                                                value="{{ session()->get('values')->empresa ?? '' }}"
                                                {{ session()->has('edit') && session()->get('edit') == 0 ? 'readonly' : '' }}>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-sm-5">
                                            <i class="fas fa-phone-alt"></i>
                                            <label class="col-form-label ml-1">Telefono</label>
                                        </div>
                                        <div class="col-sm-7">
                                            <input type="tel" class="form-control" name="telefono" placeholder=""
                                                value="{{ session()->get('values')->telefono ?? '' }}"
                                                {{ session()->has('edit') && session()->get('edit') == 0 ? 'readonly' : '' }}>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-sm-5">
                                            <i class="far fa-envelope"></i>
                                            <label class="col-form-label ml-1">Email</label>
                                        </div>
                                        <div class="col-sm-7">
                                            <input type="email" class="form-control" name="email" placeholder=""
                                                value="{{ session()->get('values')->email ?? '' }}"
                                                {{ session()->has('edit') && session()->get('edit') == 0 ? 'readonly' : '' }}>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-5">
                                            <i class="fas fa-user-alt"></i>
                                            <label class="col-form-label ml-1">Tipo cliente</label>
                                        </div>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control" name="tipoCliente" placeholder=""
                                                value="{{ session()->get('values')->tipoCliente ?? 'GENERAL' }}"
                                                readonly>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <!-- + Domicilio-->
                        <div class="col-md-6 ">
                            <div class="card sucursales-form__card h-100">
                                <div class="card-header text-center">Domicilio</div>
                                <div class="card-body d-flex flex-column justify-content-around">

                                    <div class="form-group row">
                                        <div class="col-sm-5">
                                            <i class="fas fa-house-user"></i>
                                            <label class="col-form-label ml-1">Domicilio Linea1</label>
                                        </div>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control" name="domicilio1"
                                                placeholder="Domicilio 1"
                                                value="{{ session()->get('values')->domicilio1 ?? '' }}"
                                                {{ session()->has('edit') && session()->get('edit') == 0 ? 'readonly' : '' }}>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-sm-5">
                                            <i class="fas fa-house-user"></i>
                                            <label class="col-form-label ml-1">Domicilio
                                                Linea2</label>
                                        </div>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control" name="domicilio2"
                                                placeholder="Domicilio 2"
                                                value="{{ session()->get('values')->domicilio2 ?? '' }}"
                                                {{ session()->has('edit') && session()->get('edit') == 0 ? 'readonly' : '' }}>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-sm-5">
                                            <i class="fas fa-house-user"></i>
                                            <label class="col-form-label ml-1">Domicilio
                                                Linea3<label>
                                        </div>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control" name="domicilio3"
                                                placeholder="Domicilio 3"
                                                value="{{ session()->get('values')->domicilio3 ?? '' }}"
                                                {{ session()->has('edit') && session()->get('edit') == 0 ? 'readonly' : '' }}>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-sm-5">
                                            <i class="fas fa-flag"></i>
                                            <label class="col-form-label ml-1">País</label>

                                        </div>
                                        <div class="col-sm-7">
                                            <select class="form-control" name="pais"
                                                {{ session()->has('edit') && session()->get('edit') == 0 ? 'readonly' : '' }}>
                                                <option>{{ session()->get('values')->pais ?? '' }}</option>
                                                <option>MX-MEXICO</option>
                                                <option>US-ESTADOS UNIDOS</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-sm-5">
                                            <i class="fas fa-address-card"></i>
                                            <label class="col-form-label ml-1">
                                                Codigo Postal
                                            </label>
                                        </div>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control" name="codigoPostal"
                                                placeholder="C.P"
                                                value="{{ session()->get('values')->codigoPostal ?? '' }}"
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
