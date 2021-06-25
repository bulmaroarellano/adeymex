<div class="col-md-12">

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header ">
                    <h4  class="font-weight-bolder">Cotizar</h4>
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
                                    : $sucursalesName?? [], 
                                        session()->get('values')->sucursal_id ?? old('sucursales'),[
                                           'placeholder' => 'Elegir Sucursal',
                                           'readonly' => session()->has('values')
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
                                <label class="col-form-label  text-primary">Direccion Origen </label>
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


                        </div>
                        {{-- PAQUETES  --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-form-label  text-primary">Direccion destino  </label>
                                    <div class="row no-gutters">
                                        <div class="col-md-10">
                                            {{ Form::select('destino',  session()->has('values') ? session()->get('values')->destino : [], 
                                                session()->has('values') ? session()->get('values')->destinoCP : old('destino'),[
                                                   'placeholder' => '',
                                                   'readonly' => session()->has('values')
                                                       ? (session()->get('edit') == 1 ? false : true )
                                                       : false,
                                                   'class' => 'zips-search form-control  col-sm-10'
                                            ])}}
                                        </div>
                                        <div class="col-md-2">
                                            <div class="input-group">
                                                    {{ Form::select('country_code',[
                                                        'CA' => 'CA',
                                                        'US' => 'US',
                                                        'MX' => 'MX',
                                                        'AR' => 'AR',
                                                        'BR' => 'BR',
                                                        'DE' => 'DE',
                                                        'ES' => 'ES',
                                                        'FR' => 'FR',
                                                    ], 
                                                        session()->get('values')->country_code ?? 'MX',[
                                                            'placeholder' => 'Pais',
                                                            'readonly' => session()->has('values')
                                                                ? (session()->get('edit') == 1 ? false : true )
                                                                : false,
                                                            'class' => 'country-code form-control  col-md-12 pl-1'
                                                    ])}}
                                            </div>
                                        </div>
                                    </div>
                                @error('destino')
                                        <small class="alert alert-danger">{{$message}}</small>
                                @enderror
                            </div>
                            <div class="row">
                                
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-form-label  text-primary">logistica Interna*</label>
                                        <div class="input-group input-group-merge">
                                            <div class="input-group input-group-merge">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">MXN</span>
                                                </div>
                                                {!! Form::input('number', 'cargo_logistica', session()->get('values')->cargo_logistica ?? null, [
                                                    'readonly' => session()->has('edit') ? (session()->get('edit') == 0 ? true : false) : false,
                                                    'min' => '0', 
                                                    'class' => 'form-control pl-1 cargo-logistica', 
                                                    // 'pattern' => "[0-9]{3}-[0-9]{2}-[0-9]{3}"
                                                ]) !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @include('paqueteria/envios/components/ocurre')                                    
                            </div>
                        </div>

                    </div>
                    
                </div>
            </div>
            @if ( ( session()->has('ocurres') ) && ( count( session()->get('ocurres') ) > 0 ) )
                
                
                @include('paqueteria/envios/components/table-ocurre')          

            @endif
            @include('paqueteria/envios/components/paquetes')          
            
            <div class="row d-flex justify-content-sm-around mt-2">
                
                {{-- <input class="btn btn-success" type="submit" name="cotizar" value="Cotizar" form="cotizar" /> --}}
                <label for="cotizar" class="btn btn-success">
                    Cotizar
                    <input id="cotizar" type="submit" value="true" class="hidden" name="cotizar[]"/>
                </label>

                <a href="{{ route('envios.index') }}">
                    <div class="btn btn-danger">
                        <i class="fas fa-ban mr-1"></i>
                        Cancelar
                    </div>
                </a>
            </div>

        </div>
    </div>
</div>

