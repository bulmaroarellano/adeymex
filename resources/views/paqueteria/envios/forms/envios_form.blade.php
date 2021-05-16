{{-- +  MODAL CREATE --}}
<div class="container sucursales-form">
    <div class="row d-flex justify-content-center">
        <div class="col-md-12 ">
            {{-- FORMULARIO DE COTIZACIONES  --}}
            {!! Form::open([
                'route' => 'cotizar.cotizacion',
                'method' => 'GET'
            ]) !!}

                <div class="col-md-12">

                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header ">
                                    <h4  class="font-weight-bolder">Datos Generales</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        {{-- DATOS GENERALES COTIZACION--}}
                                        <div class="col-md-6">

                                            <div class="form-group">
                                                <label class="col-form-label  text-primary">Sucursal *</label>
                                                <div class="input-group input-group-merge">
                                                    
                                                    {{ Form::select('sucursal_id',
                                                    (session()->has('sucursalesName')) 
                                                    ? session()->get('sucursalesName')
                                                    : $sucursalesName, 
                                                        session()->get('values')->sucursal_id ?? old('sucursales'),[
                                                           'placeholder' => 'Elegir Sucursal',
                                                           'disabled' => session()->has('values')
                                                               ? (session()->get('edit') == 1 ? false : true )
                                                               : false,
                                                           'class' => 'sucursales-search form-control  col-md-10 pl-1'
                                                    ])}}
                                                </div>
                                                @error('sucursal')
                                                        <small class="alert alert-danger">{{$message}}</small>
                                                @enderror
                                            </div>

                                            {{-- direccion de la sucursal   --}}
                                            <div class="form-group">
                                                <label class="col-form-label  text-primary">Direccion Origen  </label>
                                                <div class="input-group input-group-merge">
                                                    
                                                    {!! Form::text(
                                                        'origen', session()->get('values')->origen ?? '',[
                                                            'readonly' => session()->has('edit') 
                                                            ? session()->get('edit') == 0 ? true : false
                                                            : false,
                                                            'class' => 'origen-envio form-control pl-1'
                                                        ]) 
                                                    !!}
                                                </div>
                                                @error('cp_sucursal')
                                                        <small class="alert alert-danger">{{$message}}</small>
                                                @enderror
                                            </div>

                                            {{-- BUSCADORES CP_SEṔOMEX  --}}
                                            <div class="form-group">
                                                <label class="col-form-label  text-primary">Direccion destino  </label>
                                                <div class="input-group input-group-merge">
                                                    
                                                    {{ Form::select('destino',  session()->has('sepomex') ?session()->get('values')->destino : [], 
                                                        session()->has('values') ? session()->get('values')->destino : '',[
                                                           'placeholder' => '',
                                                           'disabled' => session()->has('values')
                                                               ? (session()->get('edit') == 1 ? false : true )
                                                               : false,
                                                           'class' => 'sepomex-search form-control  col-sm-12'
                                                    ])}}
                                                </div>
                                                @error('destino')
                                                        <small class="alert alert-danger">{{$message}}</small>
                                                @enderror
                                            </div>
                                            

                                        </div>
                                        {{-- PAQUETES  --}}
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="col-form-label  text-primary">Tipo de paquete</label>
                                                <div class="input-group input-group-merge">
                                                    
                                                    {{ Form::select('type_paquete',[
                                                        '1' => 'paquete',
                                                        '2' => 'documento',
                                                        '3' => 'fedex-pak'
                                                    ], 
                                                        session()->get('values')->type_paquete ?? '',[
                                                            'placeholder' => 'Elegir tipo de paquete',
                                                            'disabled' => session()->has('values')
                                                                ? (session()->get('edit') == 1 ? false : true )
                                                                : false,
                                                            'class' => 'type-paquete form-control  col-md-10 pl-1'
                                                    ])}}
                                                </div>
                                                @error('sucursal')
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
                            {{ session()->get('edit') ? 'Cotizar' : 'Crear' }}
                        </button>
                        <a href="{{ route('envios.index') }}">
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
