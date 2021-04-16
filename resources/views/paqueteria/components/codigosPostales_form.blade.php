{{-- +  MODAL CREATE --}}
<div class="container sucursales-form">
    <div class="row d-flex justify-content-center">
        <div class="col-md-12 ">
            <form 
                action="{{ session()->get('edit') == 1 ? route('codigosPostales.update', session()->get('values') ?? '') : route('codigosPostales.store') }}"
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
                                <div class="card-header text-center">Codigos Postales</div>
                                <div class="card-body d-flex flex-column justify-content-around">

                                    <div class="form-group row mt-2">
                                        <div class="col-sm-5">
                                            <i class="fas fa-house-user"></i>
                                            <label class="col-form-label ml-1">Codigo Postal</label>
                                        </div>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control" name="codigoPostal"
                                                placeholder="C.P"
                                                value="{{ session()->get('values')->codigoPostal ?? '' }}"
                                                {{ session()->has('edit') && session()->get('edit') == 0 ? 'readonly' : '' }}>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-sm-5">
                                            <i class="fas fa-house-user"></i>
                                            <label class="col-form-label ml-1">Dirección</label>
                                        </div>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control" name="direccion"
                                                placeholder=""
                                                value="{{ session()->get('values')->direccion ?? '' }}"
                                                {{ session()->has('edit') && session()->get('edit') == 0 ? 'readonly' : '' }}>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-sm-5">
                                            <i class="fas fa-house-user"></i>
                                            <label class="col-form-label ml-1">Ciudad<label>
                                        </div>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control" name="ciudad"
                                                placeholder=""
                                                value="{{ session()->get('values')->ciudad ?? '' }}"
                                                {{ session()->has('edit') && session()->get('edit') == 0 ? 'readonly' : '' }}>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-sm-5">
                                            <i class="fas fa-house-user"></i>
                                            <label class="col-form-label ml-1">Codigo Estado<label>
                                        </div>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control" name="codigoEstado"
                                                placeholder="EM, BC, CdMX "
                                                value="{{ session()->get('values')->codigoEstado ?? '' }}"
                                                {{ session()->has('edit') && session()->get('edit') == 0 ? 'readonly' : '' }}>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-sm-5">
                                            <i class="fas fa-house-user"></i>
                                            <label class="col-form-label ml-1">Municipio<label>
                                        </div>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control" name="municipio"
                                                placeholder=""
                                                value="{{ session()->get('values')->municipio ?? '' }}"
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
