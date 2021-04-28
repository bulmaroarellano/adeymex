{{-- +  MODAL CREATE --}}
<div class="container sucursales-form">
    <div class="row d-flex justify-content-center">
        <div class="col-md-12 ">

            {!! Form::open([
                'route' => session()->get('edit') == 1 ? ['mercancias.update', session()->get('values') ?? ''] : 'mercancias.store',
                'method' => session()->get('edit') == 1 ? 'PUT' : 'POST',
            ]) !!}

                <div class="col-md-12">

                    <div class="row justify-content-center">

                        <!-- + Datos generales-->
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header ">
                                    <h4  class="font-weight-bolder">Datos Generales</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        {{-- DATOS GENERALES --}}
                                        <div class="col-md-6">

                                            <div class="form-group">
                                                <label class="col-form-label text-primary">Producto *</label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="far fa-user"></i></span>
                                                    </div>
                                                    {!! Form::text(
                                                        'producto', session()->get('values')->producto ?? '',[
                                                            'readonly' => session()->has('edit') 
                                                            ? session()->get('edit') == 0 ? true : false
                                                            : false,
                                                            'class' => 'form-control pl-1'
                                                        ]) 
                                                    !!}
                                                </div>
                                                @error('producto')
                                                    <small class="alert alert-danger">{{$message}}</small>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label class="col-form-label text-primary">Producto Ingles</label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="far fa-user"></i></span>
                                                    </div>
                                                    {!! Form::text(
                                                        'productoIngles', session()->get('values')->productoIngles ?? '',[
                                                            'readonly' => session()->has('edit') 
                                                            ? session()->get('edit') == 0 ? true : false
                                                            : false,
                                                            'class' => 'form-control pl-1'
                                                        ]) 
                                                    !!}
                                                </div>
                                                @error('productoIngles')
                                                    <small class="alert alert-danger">{{$message}}</small>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label class="col-form-label text-primary">Clave Internacional*</label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="far fa-user"></i></span>
                                                    </div>
                                                    {!! Form::text(
                                                        'claveInternacional', session()->get('values')->claveInternacional ?? '',[
                                                            'readonly' => session()->has('edit') 
                                                            ? session()->get('edit') == 0 ? true : false
                                                            : false,
                                                            'class' => 'form-control pl-1'
                                                        ]) 
                                                    !!}
                                                </div>
                                                @error('claveInternacional')
                                                    <small class="alert alert-danger">{{$message}}</small>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label class="col-form-label text-primary">Costo*</label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="far fa-user"></i></span>
                                                    </div>
                                                    {!! Form::text(
                                                        'costo', session()->get('values')->costo ?? '',[
                                                            'readonly' => session()->has('edit') 
                                                            ? session()->get('edit') == 0 ? true : false
                                                            : false,
                                                            'class' => 'form-control pl-1'
                                                        ]) 
                                                    !!}
                                                </div>
                                                @error('costo')
                                                    <small class="alert alert-danger">{{$message}}</small>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label class="col-form-label  text-primary">Moneda</label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-coins"></i></span>
                                                    </div>
                                                    {{ Form::select('moneda',
                                                    (session()->has('monedas')) 
                                                    ? session()->get('monedas')
                                                    : $monedas, 
                                                        session()->get('values')->moneda ?? '',[
                                                           'placeholder' => 'Elegir Moneda',
                                                           'disabled' => session()->has('values')
                                                               ? (session()->get('edit') == 1 ? false : true )
                                                               : false,
                                                           'class' => 'form-control  col-md-10 pl-1'
                                                    ])}}
                                                </div>
                                                @error('moneda')
                                                        <small class="alert alert-danger">{{$message}}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        {{-- PAQUETES  --}}
                                        <div class="col-md-6">

                                            <div class="form-group">
                                                <label class="col-form-label text-primary">Medida</label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-ruler-horizontal"></i></span>
                                                    </div>
                                                    {!! Form::text(
                                                        'medida', session()->get('values')->medida ?? '',[
                                                            'readonly' => session()->has('edit') 
                                                            ? session()->get('edit') == 0 ? true : false
                                                            : false,
                                                            'class' => 'form-control pl-1'
                                                        ]) 
                                                    !!}
                                                </div>
                                                @error('medida')
                                                    <small class="alert alert-danger">{{$message}}</small>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label class="col-form-label  text-primary">Unidad de medida</label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-balance-scale"></i></span>
                                                    </div>
                                                    {{ Form::select('unidadMedida',
                                                    (session()->has('unidadMedidas')) 
                                                    ? session()->get('unidadMedidas')
                                                    : $unidadMedidas, 
                                                        session()->get('values')->unidadMedida ?? '',[
                                                           'placeholder' => 'Elegir Unidad de Medida',
                                                           'disabled' => session()->has('values')
                                                               ? (session()->get('edit') == 1 ? false : true )
                                                               : false,
                                                           'class' => 'form-control  col-md-10 pl-1'
                                                    ])}}
                                                </div>
                                                @error('unidadMedida')
                                                        <small class="alert alert-danger">{{$message}}</small>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label class="col-form-label  text-primary">Pais</label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-globe-americas"></i></span>
                                                    </div>
                                                    {{ Form::select('pais',
                                                    (session()->has('paises')) 
                                                    ? session()->get('paises')
                                                    : $paises, 
                                                        session()->get('values')->pais ?? '',[
                                                           'placeholder' => 'Elegir Pais',
                                                           'disabled' => session()->has('values')
                                                               ? (session()->get('edit') == 1 ? false : true )
                                                               : false,
                                                           'class' => 'form-control  col-md-10 pl-1'
                                                    ])}}
                                                </div>
                                                @error('pais')
                                                        <small class="alert alert-danger">{{$message}}</small>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label class="col-form-label text-primary">Peso [Kg]</label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"> <i class="fas fa-weight-hanging"></i></span>
                                                    </div>
                                                    {!! Form::text(
                                                        'peso', session()->get('values')->peso ?? '',[
                                                            'readonly' => session()->has('edit') 
                                                            ? session()->get('edit') == 0 ? true : false
                                                            : false,
                                                            'class' => 'form-control pl-1'
                                                        ]) 
                                                    !!}
                                                </div>
                                                @error('peso')
                                                    <small class="alert alert-danger">{{$message}}</small>
                                                @enderror
                                            </div>

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
                        <a href="{{ route('mercancias.index') }}">
                            <div class="btn btn-danger">
                                <i class="fas fa-ban mr-1"></i>
                                Cancelar
                            </div>
                        </a>

                    </div>
                </div>

            {!! Form::close() !!}
        </div>
    </div>

</div>
{{-- +  MODAL FIN CREATE --}}
