<div class="col-md-12">

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header ">
                    <h4  class="font-weight-bolder">Recoleccion</h4>
                </div>
                <div class="card-body">
                    <div class="row ">
                        {{-- DATOS GENERALES COTIZACION--}}
                        <div class="col-md-5">
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
                                           'class' => 'sucursales-search form-control   pl-1'
                                    ])}}
                                </div>
                                @error('sucursal')
                                        <small class="alert alert-danger">{{$message}}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="col-form-label  text-primary">Paqueteria*</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group input-group-merge">
                                        
                                        {{ Form::select('paquteria',[
                                            'FEDEX' => 'FEDEX',
                                            'DHL' => 'DHL',
                                            'UPS' => 'UPS'
                                             ], 
                                            '',[
                                                'placeholder' => 'Seleccionar',
                                                'readonly' => session()->has('values')
                                                    ? (session()->get('edit') == 1 ? false : true )
                                                    : false,
                                                'class' => 'paquteria form-control '
                                        ])}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                        <div class="col-md-6">
                            
                            <div class="row">
                                
                            </div>
                        </div>

                    </div>
                    
                    
                </div>
            </div>
        </div>
    </div>
</div>

