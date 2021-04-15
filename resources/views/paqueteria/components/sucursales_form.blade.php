{{-- +  MODAL CREATE --}}
<div class="container sucursales-form">
    <div class="row d-flex justify-content-center">
        {{-- {{$data = session()->get('sucursalVal') }} --}}
        <div class="col-md-12 ">
            <form
                action="{{ session()->get('edit') == 1 ? route('sucursales.update', session()->get('sucursalVal') ?? '') : route('sucursales.store') }}"
                method="POST">

                @csrf
                @if (session()->get('edit') == 1)

                    @method('put')
                    actulizando
                @endif

                <div class="col-md-12">
                    <div class="row justify-content-between">

                        <!-- + Datos generales-->
                        <div class="col-md-6">
                            <div class="card sucursales-form__card h-100">
                                <div class="card-header">Datos generales</div>
                                <div class="card-body d-flex flex-column justify-content-around">


                                    <div class="form-group row">
                                        <div class="col-sm-5">
                                            <i class="fas fa-store"></i>
                                            <label class="col-form-label ml-1">
                                                Descripción
                                            </label>
                                        </div>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control" name="descripcion"
                                                placeholder="Nombre sucursal"
                                                value="{{ session()->get('sucursalVal')->descripcion ?? '' }}"
                                                {{ session()->has('edit') && session()->get('edit') == 0 ? 'readonly' : '' }}>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-sm-5">
                                            <i class="fas fa-phone-alt"></i>
                                            <label class="col-form-label ml-1">Telefono</label>

                                        </div>
                                        <div class="col-sm-7">
                                            <input type="tel" class="form-control" name="telefono"
                                                placeholder="Numero de telefono"
                                                value="{{ session()->get('sucursalVal')->telefono ?? '' }}"
                                                {{ session()->has('edit') && session()->get('edit') == 0 ? 'readonly' : '' }}>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-sm-5">
                                            <i class="fas fa-envelope"></i>
                                            <label class="col-form-label ml-1">Email</label>

                                        </div>
                                        <div class="col-sm-7">
                                            <input type="email" class="form-control" name="email" placeholder="Email"
                                                value="{{ session()->get('sucursalVal')->email ?? '' }}"
                                                {{ session()->has('edit') && session()->get('edit') == 0 ? 'readonly' : '' }}>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-sm-5">
                                            <i class="fas fa-user-alt"></i>
                                            <label class="col-form-label ml-1">Encargado</label>

                                        </div>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control" name="encargado"
                                                placeholder="Nombre del encargado"
                                                value="{{ session()->get('sucursalVal')->encargado ?? '' }}"
                                                {{ session()->has('edit') && session()->get('edit') == 0 ? 'readonly' : '' }}>
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
                                            <label class="col-form-label ml-1">Domicilio
                                                Linea1</label>
                                        </div>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control" name="domicilio1"
                                                placeholder="Domicilio 1"
                                                value="{{ session()->get('sucursalVal')->domicilio1 ?? '' }}"
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
                                                value="{{ session()->get('sucursalVal')->domicilio2 ?? '' }}"
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
                                                value="{{ session()->get('sucursalVal')->domicilio3 ?? '' }}"
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
                                                <option>{{ session()->get('sucursalVal')->pais ?? '' }}</option>
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
                                                value="{{ session()->get('sucursalVal')->codigoPostal ?? '' }}"
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
