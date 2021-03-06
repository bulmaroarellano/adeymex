{{-- +  MODAL CREATE --}}
<div class="container sucursales-form">
    <div class="row d-flex justify-content-center">
        @if ($errors->any())
             <div class="alert alert-danger">
                 <ul>
                     @foreach ($errors->all() as $error)
                         <li>{{ $error }}</li>
                     @endforeach
                 </ul>
             </div>
        @endif
        <div class="col-md-12 ">

            {!! Form::open([
             'route' => ($remitentes ?? null) != null ? (session()->get('edit') == 1 ? ['remitentes.update', session()->get('values') ?? ''] : 'remitentes.store') : (session()->get('edit') == 1 ? ['destinatarios.update', session()->get('values') ?? ''] : 'destinatarios.store'),
            'method' => session()->has('edit') ? (session()->get('edit') == 1 ? 'PUT' : 'POST') : 'POST',
            ]) !!}
            {{-- @csrf --}}
            <div class="card h-100">
                <div class="row justify-content-between">
                    {{-- DATOS GENERALES --}}
                    <div class="col-md-6">
                        <div class="card-header">
                            <h4  class="font-weight-bolder">Datos generales</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 ">

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

                                    <div class="form-group">
                                        <label class="col-form-label text-primary">Nombre *</label>
                                        <div class="input-group input-group-merge">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="far fa-user"></i></span>
                                            </div>
                                            {!! Form::text(
                                                'nombre', session()->get('values')->nombre ?? '',[
                                                    'readonly' => session()->has('edit') 
                                                    ? session()->get('edit') == 0 ? true : false
                                                    : false,
                                                    'class' => 'form-control pl-1'
                                                ]) 
                                            !!}
                                        </div>
                                        @error('nombre')
                                            <small class="alert alert-danger">{{$message}}</small>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label class="col-form-label  text-primary">Apellido Paterno *</label>
                                        
                                        <div class="input-group input-group-merge">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="far fa-user"></i></span>
                                            </div>
                                            {!! Form::text(
                                                'apellido_paterno', session()->get('values')->apellido_paterno ?? '',[
                                                    'readonly' => session()->has('edit') 
                                                    ? session()->get('edit') == 0 ? true : false
                                                    : false,
                                                    'class' => 'form-control pl-1'
                                                ]) 
                                            !!}
                                            
                                        </div>
                                        @error('apellido_paterno')
                                            <small class="alert alert-danger">{{$message}}</small>
                                        @enderror
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="col-form-label  text-primary">Apellido Materno</label>
                                        <div class="input-group input-group-merge">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="far fa-user"></i></span>
                                            </div>
                                            {!! Form::text(
                                                'apellido_materno', session()->get('values')->apellido_materno ?? '',[
                                                    'readonly' => session()->has('edit') 
                                                    ? session()->get('edit') == 0 ? true : false
                                                    : false,
                                                    'class' => 'form-control pl-1'
                                                ]) 
                                            !!}
                                            
                                        </div>
                                        
                                    </div>
                                </div>

                                <div class="col-md-6">

                                    <div class="form-group">
                                        <label class="col-form-label  text-primary">Empresa</label>
                                        <div class="input-group input-group-merge">
                                            
                                            {{ Form::select('empresa_id',
                                                    (session()->has('empresas')) 
                                                    ? session()->get('empresas')
                                                    : $empresas, 
                                                    session()->has('values') ? session()->get('values')->empresa_id : '',[
                                                        'placeholder' => '',
                                                        'disabled' => session()->has('values')
                                                            ? (session()->get('edit') == 1 ? false : true )
                                                            : false,
                                                        'class' => 'empresas-search form-control  col-sm-12'
                                            ])}}
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-form-label  text-primary">Telefono *</label>
                                        <div class="input-group input-group-merge">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-phone-alt"></i></span>
                                            </div>
                                            {!! Form::text(
                                                'telefono', session()->get('values')->telefono ?? '',[
                                                    'readonly' => session()->has('edit') 
                                                    ? session()->get('edit') == 0 ? true : false
                                                    : false,
                                                    'class' => 'form-control pl-1'
                                                ]) 
                                            !!}
                                        </div>
                                        @error('telefono')
                                            <small class="alert alert-danger">{{$message}}</small>
                                        @enderror
                                    </div>
                                    
                                    @if (($remitentes ?? null))
                                        <div class="form-group">
                                            <label class="col-form-label  text-primary">Tipo cliente</label>
                                            <div class="input-group input-group-merge">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                                </div>
                                                
                                                {{ Form::select('cliente_id',
                                                (session()->has('clientes')) 
                                                ? session()->get('clientes')
                                                : $clientes, 
                                                session()->has('values') ? session()->get('values')->cliente_id : '',[
                                                   'placeholder' => '',
                                                   'disabled' => session()->has('clientes')
                                                       ? (session()->get('edit') == 1 ? false : true )
                                                       : false,
                                                   'class' => 'clientes-search form-control  col-sm-12'
                                                ])}}
                                                
                                            </div>
                                        </div>
                                    @endif
                                    <div class="form-group ">
                                        <label class="col-form-label  text-primary">Email</label>
                                        <div class="input-group input-group-merge">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="far fa-envelope"></i></span>
                                                {!! Form::email(
                                                    'email', session()->get('values')->email ?? '',[
                                                        'readonly' => session()->has('edit') 
                                                        ? session()->get('edit') == 0 ? true : false
                                                        : false,
                                                        'class' => 'form-control col-md-12'
                                                    ]) 
                                                !!}
                                            </div>
                                        </div>
                                        @error('email')
                                            <small class="alert alert-danger">{{$message}}</small>
                                        @enderror
                                    </div>
                                   

                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- DOMICILIO --}}
                    <div class="col-md-6">
                        <div class="card-header">
                            <h4 class="font-weight-bolder">Domicilio</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-11 ">
                                    <div class="form-group px-2">
                                        <label class="col-form-label mr-1 text-primary">Domicilio Linea1 *</label>
                                        
                                        <div class="input-group input-group-merge">
                                            <div class="input-group-prepend">
                                              <span class="input-group-text"><i class="fas fa-home"></i></span>
                                            </div>
                                            {!! Form::text(
                                                'domicilio1', session()->get('values')->domicilio1 ?? '',[
                                                    'readonly' => session()->has('edit') 
                                                    ? session()->get('edit') == 0 ? true : false
                                                    : false,
                                                    'class' => 'form-control pl-1'
                                                ]) 
                                            !!}
                                            
                                        </div>
                                    </div>
                                    @error('domicilio1')
                                        <small class="alert alert-danger ml-2">{{$message}}</small>
                                    @enderror

                                    <div class="form-group px-2 ">
                                        <label class="col-form-label mr-1 text-primary">Domicilio Linea 2</label>
                                        
                                        <div class="input-group input-group-merge">
                                            <div class="input-group-prepend">
                                              <span class="input-group-text"><i class="fas fa-home"></i></span>
                                            </div>
                                            {!! Form::text(
                                                'domicilio2', session()->get('values')->domicilio2 ?? '',[
                                                    'readonly' => session()->has('edit') 
                                                    ? session()->get('edit') == 0 ? true : false
                                                    : false,
                                                    'class' => 'form-control pl-1'
                                                ]) 
                                            !!}
                                        </div>
                                        
                                    </div>
                                    <div class="form-group px-2 ">
                                        <label class="col-form-label mr-1 text-primary">Domicilio Linea 3</label>
                                        <div class="input-group input-group-merge">
                                            <div class="input-group-prepend">
                                              <span class="input-group-text"><i class="fas fa-home"></i></span>
                                            </div>
                                            {!! Form::text(
                                                'domicilio3', session()->get('values')->domicilio3 ?? '',[
                                                    'readonly' => session()->has('edit') 
                                                    ? session()->get('edit') == 0 ? true : false
                                                    : false,
                                                    'class' => 'form-control pl-1'
                                                ]) 
                                            !!}
                                        </div>
                                    </div>

                                    <div class="row ">
                                        <div class="col-md-6">
                                            <div class="form-group px-2">
                                                <label class="col-form-label mr-2 text-primary">Codigo Postal * </label>
                                                
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                      <span class="input-group-text"><i class="far fa-address-card"></i></span>
                                                    </div>
                                                    {!! Form::text(
                                                        'codigo_postal', session()->get('values')->codigo_postal ?? '',[
                                                            'readonly' => session()->has('edit') 
                                                            ? session()->get('edit') == 0 ? true : false
                                                            : false,
                                                            'class' => 'form-control  col-sm-10 pl-1'
                                                        ]) 
                                                    !!}
                                                    
                                                </div>
                                            </div>
                                            @error('codigoPostal')
                                                <small class="alert alert-danger ml-2">{{$message}}</small>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group px-2">
                                                <label class="col-form-label mr-3 text-primary">Pa??s * </label>
                                                
                                                <div class="input-group input-group-merge">
                                                   
                                                    {{ Form::select('pais_id',
                                                        (session()->has('paises')) 
                                                        ? session()->get('paises')
                                                        : $paises, 
                                                        session()->has('values') ? session()->get('values')->pais_id : '',[
                                                           'placeholder' => '',
                                                           'disabled' => session()->has('paises')
                                                               ? (session()->get('edit') == 1 ? false : true )
                                                               : false,
                                                           'class' => 'paises-search form-control  col-sm-12'
                                                        ])}}
                                                </div>
                                                
                                            </div>
                                            @error('pais')
                                                <small class="alert alert-danger ml-2">{{$message}}</small>
                                            @enderror
                                        </div>
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
                <a href="{{($remitentes ?? null)  != null ? route('remitentes.index') : route('destinatarios.index')}}">
                    <div class="btn btn-danger">
                        <i class="fas fa-ban mr-1"></i>
                        Cancelar
                    </div>
                </a>
            </div>
            {!! Form::close() !!}
            
        </div>
    </div>

</div>
{{-- +  MODAL FIN CREATE --}}
