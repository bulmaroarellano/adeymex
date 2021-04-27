{{-- +  MODAL CREATE --}}
<div class="container sucursales-form">
    <div class="row d-flex justify-content-center">
        <div class="col-md-12 ">
            <form 
                action="{{ session()->get('edit') == 1 ? route('unidadesMedida.update', session()->get('values') ?? '') : route('unidadesMedida.store') }}"
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
                                <div class="card-header text-center">Unidades de Medida</div>
                                <div class="card-body d-flex flex-column justify-content-around">

                                    <div class="form-group row mt-2">
                                        <div class="col-sm-5">
                                            <i class="fas fa-weight-hanging"></i>
                                            <label class="col-form-label ml-1">Unidad</label>
                                        </div>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control" name="unidadMedida"
                                                placeholder="kilogramo, litro"
                                                value="{{ session()->get('values')->unidadMedida ?? '' }}"
                                                {{ session()->has('edit') && session()->get('edit') == 0 ? 'readonly' : '' }}>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-sm-5">
                                            <i class="fas fa-ruler-horizontal"></i>
                                            <label class="col-form-label ml-1">Abreviación</label>
                                        </div>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control" name="abreviacion"
                                                placeholder="Kg, L, ml"
                                                value="{{ session()->get('values')->abreviacion ?? '' }}"
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
