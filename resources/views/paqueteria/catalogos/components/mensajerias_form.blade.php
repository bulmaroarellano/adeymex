<div class="container sucursales-form"></div>
    <div class="row ">
        <div class="col-md-12 d-flex justify-content-center">
            {!! Form::open([
                    'route' => session()->get('edit') == 1 ? ['mensajerias.update', session()->get('values') ?? ''] : 'mensajerias.store',
                    'method' => session()->get('edit') == 1 ? 'PUT': 'POST', 
                    'enctype' => 'multipart/form-data',
                    'class' => 'card col-md-8 py-2'
                ]) 
            !!}
           
                <div class="row justify-content-center">
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-header ">
                                <h4  class="font-weight-bolder">Mensajerias</h4>
                            </div>
                            <div class="card-body">
                                
                                <div class="form-group row">
                                    <div class="col-sm-3 col-form-label">
                                        <label class="col-form-label text-primary">Mensajeria *</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div class="input-group input-group-merge">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-plane-departure"></i></span>
                                            </div>
                                            {{ Form::text(
                                                'mensajeria',  session()->get('values')->mensajeria ?? '' ,[
                                                    'class' => 'form-control',
                                                    'readonly' => session()->has('edit') && session()->get('edit') == 0 ? true : false,
                                                ])
                                            }}
                                        </div>
                                    </div>
                                    @error('mensajeria')
                                        <small class="alert alert-danger ml-3 mt-1">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-3 col-form-label">
                                        <label class="col-form-label text-primary">Logo</label>
                                    </div>
                                    <div class="col-sm-6 mt-1">
                                        <div class="">
                                           
                                            {{ Form::file("logo", [
                                                'value' => session()->get('values')->logo ?? '',
                                                'class' => '',
                                            ])}}
                                        </div>
                                    </div>
                                    @error('logo')
                                        <small class="alert alert-danger ml-3 mt-1">{{ $message }}</small>
                                    @enderror
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

                        <a href="{{ route('mensajerias.index') }}">
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
