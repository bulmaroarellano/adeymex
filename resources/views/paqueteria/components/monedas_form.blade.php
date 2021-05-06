{{-- +  MODAL CREATE --}}
<div class="container sucursales-form">
    <div class="row d-flex justify-content-center">
        <div class="col-md-12 ">

            {!! Form::open([
                'route' => session()->get('edit') == 1 ? ['monedas.update', session()->get('values') ?? ''] : 'monedas.store',
                'method' => session()->get('edit') == 1 ? 'PUT' : 'POST',
            ]) !!}

            <div class="col-md-12">

                <div class="row justify-content-center">
                    <!-- + Domicilio-->
                    <div class="col-md-5">
                        <div class="card sucursales-form__card">
                            <div class="card-header ">
                                <h4  class="font-weight-bolder">Monedas</h4>
                            </div>
                            <div class="card-body">
                                <div class="form-group row">
                                    <div class="col-sm-4 col-form-label">
                                        <label class="col-form-label text-primary">Moneda *</label>
                                    </div>
                                    <div class="col-sm-7">
                                        <div class="input-group input-group-merge">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-money-bill-wave-alt"></i></span>
                                            </div>
                                            {!! Form::text('nombre', session()->get('values')->nombre ?? '', [
                                                'readonly' => session()->has('edit') ? (session()->get('edit') == 0 ? true : false) : false,
                                                'class' => 'form-control pl-1',
                                            ]) !!}
                                        </div>
                                    </div>
                                    @error('nombre')
                                        <small class="alert alert-danger ml-3 mt-1">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-4 col-form-label">
                                        <label class="col-form-label text-primary">Codigo *</label>
                                    </div>
                                    <div class="col-sm-7">
                                        <div class="input-group input-group-merge">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-coins"></i></span>
                                            </div>
                                            {!! Form::text('codigo', session()->get('values')->codigo ?? '', [
                                                'readonly' => session()->has('edit') ? (session()->get('edit') == 0 ? true : false) : false,
                                                'class' => 'form-control pl-1',
                                            ]) !!}
                                        </div>
                                    </div>
                                    @error('codigo')
                                        <small class="alert alert-danger ml-3 mt-1">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-4 col-form-label">
                                        <label class="col-form-label text-primary">Simbolo </label>
                                    </div>
                                    <div class="col-sm-7">
                                        <div class="input-group input-group-merge">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                            </div>
                                            {!! Form::text('simbolo', session()->get('values')->simbolo ?? '', [
                                                'readonly' => session()->has('edit') ? (session()->get('edit') == 0 ? true : false) : false,
                                                'class' => 'form-control pl-1',
                                            ]) !!}
                                        </div>
                                    </div>
                                    @error('simbolo')
                                        <small class="alert alert-danger ml-3 mt-1">{{ $message }}</small>
                                    @enderror
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="row d-flex justify-content-center">
                <div class="col-md-6">
                    <div class="row d-flex justify-content-sm-around ">
                        <button class="btn btn-secondary" type="submit">
                            {{ session()->get('edit') ? 'Actualizar' : 'Crear' }}
                        </button>
                        <a href="{{ route('monedas.index') }}">
                            <div class="btn btn-danger">
                                <i class="fas fa-ban mr-1"></i>
                                Cancelar
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>

</div>
{{-- +  MODAL FIN CREATE --}}
