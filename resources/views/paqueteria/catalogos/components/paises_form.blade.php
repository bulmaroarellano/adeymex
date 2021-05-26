{{-- +  MODAL CREATE --}}
<div class="container sucursales-form">
    <div class="row d-flex justify-content-center">
        <div class="col-md-12 ">
            
            {!! Form::open([
                'route' => session()->get('edit') == 1 ? ['paises.update', session()->get('values') ?? ''] : 'paises.store',
                'method' => session()->get('edit') == 1 ? 'PUT' : 'POST',
            ]) !!}
                <div class="col-md-12">

                    <div class="row justify-content-center">
                        <!-- + suministros -->
                        <div class="col-md-5">
                            <div class="card">
                                <div class="card-header ">
                                    <h4  class="font-weight-bolder">Paises</h4>
                                </div>
                                <div class="card-body">
                                    <div class="form-group row">
                                        <div class="col-sm-3 col-form-label">
                                            <label class="col-form-label text-primary">Pais *</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <div class="input-group input-group-merge">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-globe-americas"></i></span>
                                                </div>
                                                {!! Form::text('nombre', session()->get('values')->nombre ?? '', [
                                                    'readonly' => session()->has('edit') ? (session()->get('edit') == 0 ? true : false) : false,
                                                    'class' => 'form-control pl-1',
                                                ]) !!}
                                            </div>
                                        </div>
                                        @error('nombre')
                                            <small class="alert alert-danger ml-3 mt-1">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-3  col-form-label text-primary">Codigo *</label>
                                        <div class="col-sm-9">
                                            <div class="input-group input-group-merge">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-flag"></i></span>
                                                </div>
                                                {!! Form::text('codigo', session()->get('values')->codigo ?? '', [
                                                    'readonly' => session()->has('edit') ? (session()->get('edit') == 0 ? true : false) : false,
                                                    'class' => 'form-control pl-1',
                                                ]) !!}
                                            </div>
                                        </div>
                                        @error('codigo')
                                            <small class="alert alert-danger ml-3 mt-1">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="form-group row">
                                        
                                        <label class="col-sm-3 col-form-label text-primary">Moneda</label>
                                        <div class="col-sm-9">
                                            <div class="input-group input-group-merge">
                                               
                                                {{ Form::select('moneda_id',
                                                    (session()->has('monedas')) 
                                                    ? session()->get('monedas')
                                                    : $monedas, 
                                                        session()->get('values')->moneda_id ?? '',[
                                                           'placeholder' => 'Elegir Moneda',
                                                           'disabled' => session()->has('values')
                                                               ? (session()->get('edit') == 1 ? false : true )
                                                               : false,
                                                           'class' => 'monedas-search form-control  col-md-10 pl-1'
                                            ])}}
                                            </div>
                                        </div>
                                        @error('moneda_id')
                                            <small class="alert alert-danger ml-3 mt-1">{{ $message }}</small>
                                        @enderror
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
                            <a href="{{ route('paises.index') }}">
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
