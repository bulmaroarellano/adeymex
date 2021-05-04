


<div class="container sucursales-form mb-2">
    <div class="row d-flex justify-content-center">

        <div class="col-md-12">
            {!! Form::open([
                'route' => session()->get('edit') == 1 ? ['sucursales.update', session()->get('values') ?? ''] : 'sucursales.store',
                'method' => session()->get('edit') == 1 ? 'PUT' : 'POST',
            ]) !!}
    
                <div class="card">
                    <div class="row justify-content-between">
                            <!-- + Datos generales-->
                            <div class="col-md-5">
                                <div class="card sucursales-form__card h-100">
                                    <div class="card-header">
                                        <h4  class="font-weight-bolder">Datos generales</h4>
                                    </div>
                                    <div class="card-body d-flex flex-column justify-content-around">

                                        <div class="form-group row">
                                            <div class="col-sm-4 col-form-label">
                                                <label class="col-form-label ">Sucursal *</label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-store"></i></span>
                                                    </div>
                                                    {!! Form::text('sucursal', session()->get('values')->sucursal ?? '', [
                                                        'readonly' => session()->has('edit') ? (session()->get('edit') == 0 ? true : false) : false,
                                                        'class' => 'form-control pl-1',
                                                    ]) !!}
                                                </div>
                                            </div>
                                            @error('sucursal')
                                                <small class="alert alert-danger ml-3 mt-1">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-4 col-form-label">
                                                <label class="col-form-label ">Telefono *</label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-phone-alt"></i></span>
                                                    </div>
                                                    {!! Form::input('tel', 'telefono', session()->get('values')->telefono ?? '', [
                                                        'readonly' => session()->has('edit') ? (session()->get('edit') == 0 ? true : false) : false,
                                                        'class' => 'form-control pl-1', 
                                                        // 'pattern' => "[0-9]{3}-[0-9]{2}-[0-9]{3}"
                                                    ]) !!}
                                                </div>
                                            </div>
                                            @error('telefono')
                                                <small class="alert alert-danger ml-3 mt-1">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-4 col-form-label">
                                                <label class="col-form-label ">Email *</label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                                    </div>
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
                                                <small class="alert alert-danger ml-3 mt-1">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        
                                        <div class="form-group row">
                                            <div class="col-sm-4 col-form-label">
                                                <label class="col-form-label ">Encargado *</label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-user-alt"></i></span>
                                                    </div>
                                                    {!! Form::text('encargado', session()->get('values')->encargado ?? '', [
                                                        'readonly' => session()->has('edit') ? (session()->get('edit') == 0 ? true : false) : false,
                                                        'class' => 'form-control pl-1',
                                                    ]) !!}
                                                </div>
                                            </div>
                                            @error('encargado')
                                                <small class="alert alert-danger ml-3 mt-1">{{ $message }}</small>
                                            @enderror
                                        </div>  
                                    </div>
                                </div>
                            </div>
    
                            <!-- + Domicilio-->
                            <div class="col-md-7">
                                <div class="card-header">
                                    <h4 class="font-weight-bolder">Domicilio</h4>
                                </div>
                                <div class="card-body">
                                    <div class="">
                                        <div class="col-md-12">
                                            <div class="form-group row">
                                                <div class="col-sm-4 col-form-label">
                                                    <label class="col-form-label ">Domicilio Linea1 *</label>
                                                </div>
                                                <div class="col-sm-8">
                                                    <div class="input-group input-group-merge">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fas fa-home"></i></span>
                                                        </div>
                                                        {!! Form::text('domicilio1', session()->get('values')->domicilio1 ?? '', [
                                                            'readonly' => session()->has('edit') ? (session()->get('edit') == 0 ? true : false) : false,
                                                            'class' => 'form-control pl-1',
                                                        ]) !!}
                                                    </div>
                                                </div>
                                                @error('domicilio1')
                                                    <small class="alert alert-danger ml-3 mt-1">{{ $message }}</small>
                                                @enderror
                                            </div>

                                            <div class="form-group row">
                                                <div class="col-sm-4 col-form-label">
                                                    <label class="col-form-label ">Domicilio Linea2 </label>
                                                </div>
                                                <div class="col-sm-8">
                                                    <div class="input-group input-group-merge">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fas fa-home"></i></span>
                                                        </div>
                                                        {!! Form::text('domicilio2', session()->get('values')->domicilio2 ?? '', [
                                                            'readonly' => session()->has('edit') ? (session()->get('edit') == 0 ? true : false) : false,
                                                            'class' => 'form-control pl-1',
                                                        ]) !!}
                                                    </div>
                                                </div>
                                                @error('domicilio2')
                                                    <small class="alert alert-danger ml-3 mt-1">{{ $message }}</small>
                                                @enderror
                                            </div>

                                            <div class="form-group row">
                                                <div class="col-sm-4 col-form-label">
                                                    <label class="col-form-label ">Domicilio Linea3 </label>
                                                </div>
                                                <div class="col-sm-8">
                                                    <div class="input-group input-group-merge">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fas fa-home"></i></span>
                                                        </div>
                                                        {!! Form::text('domicilio3', session()->get('values')->domicilio3 ?? '', [
                                                            'readonly' => session()->has('edit') ? (session()->get('edit') == 0 ? true : false) : false,
                                                            'class' => 'form-control pl-1',
                                                        ]) !!}
                                                    </div>
                                                </div>
                                                @error('domicilio3')
                                                    <small class="alert alert-danger ml-3 mt-1">{{ $message }}</small>
                                                @enderror
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <div class="col-sm-6 col-form-label">
                                                            <label class="col-form-label ">Codigo Postal* </label>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="input-group input-group-merge">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text"><i class="far fa-address-card"></i></span>
                                                                </div>
                                                                {!! Form::text('codigoPostal', session()->get('values')->codigoPostal ?? '', [
                                                                    'readonly' => session()->has('edit') ? (session()->get('edit') == 0 ? true : false) : false,
                                                                    'class' => 'form-control ',
                                                                ]) !!}
                                                            </div>
                                                        </div>
                                                        @error('codigoPostal')
                                                            <small class="alert alert-danger ml-3 mt-1">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <div class="col-sm-3 col-form-label">
                                                            <label class="col-form-label ">País *</label>
                                                        </div>
                                                        <div class="col-sm-9">
                                                            <div class="input-group input-group-merge">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text"><i class="fas fa-globe-americas"></i></span>
                                                                </div>
                                                                {{ Form::select('pais',
                                                                (session()->has('paises')) 
                                                                ? session()->get('paises')
                                                                : $paises, 
                                                                session()->has('values') ? session()->get('values')->pais : '',[
                                                                   'placeholder' => 'Elegir pais',
                                                                   'disabled' => session()->has('paises')
                                                                       ? (session()->get('edit') == 1 ? false : true )
                                                                       : false,
                                                                   'class' => 'form-control  col-sm-12'
                                                                ])}}
                                                            </div>
                                                        </div>
                                                        @error('pais')
                                                            <small class="alert alert-danger ml-3 mt-1">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
        
                                        </div>
        
                                    </div>
                                </div>
                            </div>
    
                    </div>
                </div>
                
                <div class="row d-flex justify-content-sm-around mt-2">
    
                        <button class="btn btn-success" type="submit">
                            {{ session()->get('edit') ? 'Actualizar' : 'Crear' }}
                        </button>
    
                        <a href="{{ route('sucursales.index') }}">
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

</div>


