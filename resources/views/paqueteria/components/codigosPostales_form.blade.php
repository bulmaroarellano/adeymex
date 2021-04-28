{{-- +  MODAL CREATE --}}
<div class="container sucursales-form">
    <div class="row d-flex justify-content-center">
        <div class="col-md-12 ">
            {!! Form::open([
    'route' => session()->get('edit') == 1 ? ['codigosPostales.update', session()->get('values') ?? ''] : 'codigosPostales.store',
    'method' => session()->get('edit') == 1 ? 'PUT' : 'POST',
]) !!}

            <div class="col-md-12">
                <div class="row justify-content-center">
                    <!-- + Domicilio-->
                    <div class="col-md-7">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="font-weight-bolder">Codigos Postales </h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    {{-- DIRECCION --}}
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            
                                            <label class="col-form-label  text-primary">Codigo Postal</label>
                                            <div class="input-group input-group-merge">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="far fa-address-card"></i></span>
                                                </div>
                                                {!! Form::text('codigoPostal', session()->get('values')->codigoPostal ?? '', [
                                                    'readonly' => session()->has('edit') ? (session()->get('edit') == 0 ? true : false) : false,
                                                    'class' => 'form-control pl-1',
                                                ]) !!}
                                            </div>
                                            @error('codigoPostal')
                                                <small class="alert alert-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label class="col-form-label  text-primary">Codigo Estado</label>
                                            <div class="input-group input-group-merge">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-address-card"></i></span>
                                                </div>
                                                {!! Form::text('codigoEstado', session()->get('values')->codigoEstado ?? '', [
                                                    'readonly' => session()->has('edit') ? (session()->get('edit') == 0 ? true : false) : false,
                                                    'class' => 'form-control pl-1',
                                                ]) !!}
                                            </div>
                                            @error('codigoEstado')
                                                <small class="alert alert-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label class="col-form-label  text-primary">Municipio</label>
                                            <div class="input-group input-group-merge">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-map-marked-alt"></i></span>
                                                </div>
                                                {!! Form::text('municipio', session()->get('values')->municipio ?? '', [
                                                    'readonly' => session()->has('edit') ? (session()->get('edit') == 0 ? true : false) : false,
                                                    'class' => 'form-control pl-1',
                                                ]) !!}
                                            </div>
                                            @error('municipio')
                                                <small class="alert alert-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    {{-- Direccion, Ciudad  --}}
                                    <div class="col-md-7">
                                        <div class="form-group">
                                            <label class="col-form-label  text-primary">Direccion</label>
                                            <div class="input-group input-group-merge">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-home"></i></span>
                                                </div>
                                                {!! Form::text('direccion', session()->get('values')->direccion ?? '', [
                                                    'readonly' => session()->has('edit') ? (session()->get('edit') == 0 ? true : false) : false,
                                                    'class' => 'form-control pl-1',
                                                ]) !!}
                                            </div>
                                            @error('direccion')
                                                <small class="alert alert-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="col-form-label  text-primary">Ciudad</label>
                                            <div class="input-group input-group-merge">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-map-marked-alt"></i></span>
                                                </div>
                                                {!! Form::text('ciudad', session()->get('values')->ciudad ?? '', [
                                                    'readonly' => session()->has('edit') ? (session()->get('edit') == 0 ? true : false) : false,
                                                    'class' => 'form-control pl-1',
                                                ]) !!}
                                            </div>
                                            @error('ciudad')
                                                <small class="alert alert-danger">{{ $message }}</small>
                                            @enderror
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
                    <div class="row d-flex justify-content-sm-around">

                        <button class="btn btn-secondary" type="submit">
                            {{ session()->get('edit') ? 'Actualizar' : 'Crear' }}
                        </button>

                        <a href="{{ route('codigosPostales.index') }}">
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
