{{--    ENVIOS-FORM --}}
<div class="col-md-12" id="datos-envio" style="display: none">
{{-- <div class="col-md-12" id="datos-envio" > --}}
    <div class="card">
        <div class="card-header">
            <h4  class="font-weight-bolder">Datos envio</h4>
        </div>
        <div class="card-body">
            <div class="row">
                {{-- DATOS ENVIO REMITENTE --}}
                <div class="col-md-6">

                    <div class="form-group">
                        <label class="col-form-label  text-primary">Nombre del remitente</label>
                        <div class="input-group input-group-merge">
                            {{ Form::select('remitente_id',session()->get('values')->remitente ?? [] , 
                                session()->get('values')->remitente_id ?? '',[
                                    'placeholder' => 'Buscar Remitente ',
                                    'readonly' => session()->has('values')
                                        ? (session()->get('edit') == 1 ? false : true )
                                        : false,
                                    'class' => 'remitentes-search form-control  col-md-10 pl-1'
                            ])}}
                        </div>
                    </div>
                    {{-- PINTAR EN FUNCION DEL ID DEL REMITENTES O SINO CREAR UN ENVIO  --}}

                    <div class="form-group">
                        <label class="col-form-label  text-primary">Nombre completo del remitente</label>
                        <div class="input-group input-group-merge">
                            
                            {!! Form::text(
                                'remitente_nombre_completo', session()->get('values')->remitente_nombre_completo ?? '',[
                                    'readonly' => session()->has('edit') 
                                    ? session()->get('edit') == 0 ? true : false
                                    : false,
                                    'class' => 'remitente-nombre-completo form-control pl-1'
                                ]) 
                            !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label  text-primary">Empresa</label>
                        <div class="input-group input-group-merge">
                            
                            {!! Form::text(
                                'remitente_empresa', session()->get('values')->remitente_empresa ?? '',[
                                    'readonly' => session()->has('edit') 
                                    ? session()->get('edit') == 0 ? true : false
                                    : false,
                                    'class' => 'remitente-empresa form-control pl-1'
                                ]) 
                            !!}
                        </div>
                    </div>

                    {{-- CODIGO_POSTAL EN FUNCION DE LA COTIZACION --}}
                    <div class="form-group">
                        <label class="col-form-label  text-primary">Codigo Postal</label>
                        <div class="input-group input-group-merge">
                            
                            {!! Form::text(
                                'remitente_codigo_postal', session()->get('values')->remitente_codigo_postal ?? '',[
                                    'readonly' => session()->has('edit') 
                                    ? session()->get('edit') == 0 ? true : false
                                    : false,
                                    'class' => 'remitente-codigo-postal form-control pl-1'
                                ]) 
                            !!}
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-form-label  text-primary">Pais de Origen</label>
                        <div class="input-group input-group-merge">
                            
                            {!! Form::text(
                                'remitente_pais', session()->get('values')->remitente_pais ?? '',[
                                    'readonly' => session()->has('edit') 
                                    ? session()->get('edit') == 0 ? true : false
                                    : false,
                                    'class' => 'remitente-pais form-control pl-1'
                                ]) 
                            !!}

                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-form-label  text-primary">Domicilio 1 </label>
                        <div class="input-group input-group-merge">
                            
                            {!! Form::text(
                                'remitente_domicilio1', session()->get('values')->remitente_domicilio1 ?? '',[
                                    'readonly' => session()->has('edit') 
                                    ? session()->get('edit') == 0 ? true : false
                                    : false,
                                    'class' => 'remitente-domicilio1 form-control pl-1'
                                ]) 
                            !!}
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-form-label  text-primary">Domicilio 2</label>
                        <div class="input-group input-group-merge">
                            
                            {!! Form::text(
                                'remitente_domicilio2', session()->get('values')->remitente_domicilio2 ?? '',[
                                    'readonly' => session()->has('edit') 
                                    ? session()->get('edit') == 0 ? true : false
                                    : false,
                                    'class' => 'remitente-domicilio2 form-control pl-1'
                                ]) 
                            !!}
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-form-label  text-primary">Domicilio 3</label>
                        <div class="input-group input-group-merge">
                            
                            {!! Form::text(
                                'remitente_domicilio3', session()->get('values')->remitente_domicilio3 ?? '',[
                                    'readonly' => session()->has('edit') 
                                    ? session()->get('edit') == 0 ? true : false
                                    : false,
                                    'class' => 'remitente-domicilio3 form-control pl-1'
                                ]) 
                            !!}
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-form-label  text-primary">Telefono </label>
                        <div class="input-group input-group-merge">
                            
                            {!! Form::text(
                                'remitente_telefono', session()->get('values')->remitente_telefono ?? '',[
                                    'readonly' => session()->has('edit') 
                                    ? session()->get('edit') == 0 ? true : false
                                    : false,
                                    'class' => 'remitente-telefono form-control pl-1'
                                ]) 
                            !!}
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-form-label  text-primary">Correo </label>
                        <div class="input-group input-group-merge">
                            
                            {!! Form::text(
                                'remitente_email', session()->get('values')->remitente_email ?? '',[
                                    'readonly' => session()->has('edit') 
                                    ? session()->get('edit') == 0 ? true : false
                                    : false,
                                    'class' => 'remitente-email form-control pl-1'
                                ]) 
                            !!}
                        </div>
                    </div>

                </div>
                
                {{-- DATOS ENVIO DESTINATARIO --}}
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-form-label  text-primary">Nombre del destinatario</label>
                        <div class="input-group input-group-merge">
                            {{ Form::select('destinatario_id',session()->get('values')->destinatario ?? [] , 
                                session()->get('values')->destinatario_id ?? '',[
                                    'placeholder' => 'Buscar Destinatario ',
                                    'readonly' => session()->has('values')
                                        ? (session()->get('edit') == 1 ? false : true )
                                        : false,
                                    'class' => 'destinatarios-search form-control  col-md-10 pl-1'
                            ])}}
                        </div>
                    </div>
                    {{-- PINTAR EN FUNCION DEL ID DEL REMITENTES O SINO CREAR UN ENVIO  --}}

                    <div class="form-group">
                        <label class="col-form-label  text-primary">Nombre completo del destinatario</label>
                        <div class="input-group input-group-merge">
                            
                            {!! Form::text(
                                'destinatario_nombre_completo', session()->get('values')->destinatario_nombre_completo ?? '',[
                                    'readonly' => session()->has('edit') 
                                    ? session()->get('edit') == 0 ? true : false
                                    : false,
                                    'class' => 'destinatario-nombre-completo form-control pl-1'
                                ]) 
                            !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label  text-primary">Empresa</label>
                        <div class="input-group input-group-merge">
                            
                            {!! Form::text(
                                'destinatario_empresa', session()->get('values')->destinatario_empresa ?? '',[
                                    'readonly' => session()->has('edit') 
                                    ? session()->get('edit') == 0 ? true : false
                                    : false,
                                    'class' => 'destinatario-empresa form-control pl-1'
                                ]) 
                            !!}
                        </div>
                    </div>

                    {{-- CODIGO_POSTAL EN FUNCION DE LA COTIZACION --}}
                    <div class="form-group">
                        <label class="col-form-label  text-primary">Codigo Postal</label>
                        <div class="input-group input-group-merge">
                            
                            {!! Form::text(
                                'destinatario_codigo_postal', session()->get('values')->destinatario_codigo_postal ?? '',[
                                    'readonly' => session()->has('edit') 
                                    ? session()->get('edit') == 0 ? true : false
                                    : false,
                                    'class' => 'destinatario-codigo-postal form-control pl-1'
                                ]) 
                            !!}
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-form-label  text-primary">Pais de Origen</label>
                        <div class="input-group input-group-merge">
                            
                            {!! Form::text(
                                'destinatario_pais', session()->get('values')->destinatario_pais ?? '',[
                                    'readonly' => session()->has('edit') 
                                    ? session()->get('edit') == 0 ? true : false
                                    : false,
                                    'class' => 'destinatario-pais form-control pl-1'
                                ]) 
                            !!}

                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-form-label  text-primary">Domicilio 1 </label>
                        <div class="input-group input-group-merge">
                            
                            {!! Form::text(
                                'destinatario_domicilio1', session()->get('values')->destinatario_domicilio1 ?? '',[
                                    'readonly' => session()->has('edit') 
                                    ? session()->get('edit') == 0 ? true : false
                                    : false,
                                    'class' => 'destinatario-domicilio1 form-control pl-1'
                                ]) 
                            !!}
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-form-label  text-primary">Domicilio 2</label>
                        <div class="input-group input-group-merge">
                            
                            {!! Form::text(
                                'destinatario_domicilio2', session()->get('values')->destinatario_domicilio2 ?? '',[
                                    'readonly' => session()->has('edit') 
                                    ? session()->get('edit') == 0 ? true : false
                                    : false,
                                    'class' => 'destinatario-domicilio2 form-control pl-1'
                                ]) 
                            !!}
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-form-label  text-primary">Domicilio 3</label>
                        <div class="input-group input-group-merge">
                            
                            {!! Form::text(
                                'destinatario_domicilio3', session()->get('values')->destinatario_domicilio3 ?? '',[
                                    'readonly' => session()->has('edit') 
                                    ? session()->get('edit') == 0 ? true : false
                                    : false,
                                    'class' => 'destinatario-domicilio3 form-control pl-1'
                                ]) 
                            !!}
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-form-label  text-primary">Telefono </label>
                        <div class="input-group input-group-merge">
                            
                            {!! Form::text(
                                'destinatario_telefono', session()->get('values')->destinatario_telefono ?? '',[
                                    'readonly' => session()->has('edit') 
                                    ? session()->get('edit') == 0 ? true : false
                                    : false,
                                    'class' => 'destinatario-telefono form-control pl-1'
                                ]) 
                            !!}
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-form-label  text-primary">Correo </label>
                        <div class="input-group input-group-merge">
                            
                            {!! Form::text(
                                'destinatario_email', session()->get('values')->destinatario_email ?? '',[
                                    'readonly' => session()->has('edit') 
                                    ? session()->get('edit') == 0 ? true : false
                                    : false,
                                    'class' => 'destinatario-email form-control pl-1'
                                ]) 
                            !!}
                        </div>
                    </div>

                </div>
                
            </div>
            <div class="row d-flex justify-content-sm-around mt-2">
                <button class="btn btn-success" type="submit">
                    {{ session()->get('edit') ? 'otra' : 'Enviar' }}
                </button>
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

