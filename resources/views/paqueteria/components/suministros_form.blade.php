{{-- +  MODAL CREATE --}}
<div class="container sucursales-form">
    <div class="row d-flex justify-content-center">
        <div class="col-md-12 ">
            {!! Form::open([
                'route' => session()->get('edit') == 1 ? ['suministros.update', session()->get('values') ?? ''] : 'suministros.store',
                'method' => session()->get('edit') == 1 ? 'PUT' : 'POST',
            ]) !!}

            <div class="col-md-12">
                <div class="row justify-content-center">
                    <!-- + suministros -->
                    <div class="col-md-6">
                        <div class="card ">
                            <div class="card-header ">
                                <h4  class="font-weight-bolder">Suministros</h4>
                            </div>
                            <div class="card-body ">
                                <div class="row">
                                    <div class="col-md-6">
                                        {{-- DESCRIPCION --}}
                                        <div class="form-group">
                                            <label class="col-form-label  text-primary">Sucursal *</label>
                                            <div class="input-group input-group-merge">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-store"></i></span>
                                                </div>
                                                {{ Form::select('sucursal', session()->has('sucursalesName') ? session()->get('sucursalesName') : $sucursalesName, session()->get('values')->sucursal ?? old('sucursales'), [
                                                    'placeholder' => 'Elegir Sucursal',
                                                    'disabled' => session()->has('values') ? (session()->get('edit') == 1 ? false : true) : false,
                                                    'class' => 'form-control  col-md-10 pl-1',
                                                ]) }}
                                            </div>
                                            @error('sucursal')
                                                <small class="alert alert-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label class="col-form-label text-primary">Producto *</label>
                                            <div class="input-group input-group-merge">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-archive"></i></span>
                                                </div>
                                                {!! Form::text('producto', session()->get('values')->producto ?? '', [
                                                    'readonly' => session()->has('edit') ? (session()->get('edit') == 0 ? true : false) : false,
                                                    'class' => 'form-control pl-1',
                                                ]) !!}
                                            </div>
                                            @error('producto')
                                                <small class="alert alert-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="col-md-6" style="margin-top:4.5px">
                                        {{-- PRECIOS --}}
                                        <div class="form-group">
                                            <label class="col-form-label text-primary">Costo *<label>
                                            <div class="input-group input-group-merge">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i
                                                            class="fas fa-dollar-sign"></i></span>
                                                </div>
                                                {!! Form::text('costo', session()->get('values')->costo ?? '', [
                                                    'readonly' => session()->has('edit') ? (session()->get('edit') == 0 ? true : false) : false,
                                                    'class' => 'form-control pl-1',
                                                ]) !!}
                                                <div class="input-group-append">
                                                    <span class="input-group-text">MXN</span>
                                                </div>
                                            </div>
                                            @error('costo')
                                                <small class="alert alert-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label class="col-form-label text-primary">Precio Publico<label>
                                            <div class="input-group input-group-merge">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i
                                                            class="fas fa-donate"></i></span>
                                                </div>
                                                {!! Form::text('precioPublico', session()->get('values')->precioPublico ?? '', [
                                                    'readonly' => session()->has('edit') ? (session()->get('edit') == 0 ? true : false) : false,
                                                    'class' => 'form-control pl-1',
                                                ]) !!}
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
            </div>

            <div class="row d-flex justify-content-center">
                <div class="col-md-6">
                    <div class="row d-flex justify-content-sm-around mt-2">

                        <button class="btn btn-secondary" type="submit">
                            {{ session()->get('edit') ? 'Actualizar' : 'Crear' }}
                        </button>

                        <a href="{{ route('suministros.index') }}">
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
