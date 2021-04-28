{{-- +  MODAL CREATE --}}
<div class="container sucursales-form">
    <div class="row d-flex justify-content-center">
        <div class="col-md-12 ">
            {!! Form::open([
                'route' => session()->get('edit') == 1 ? ['unidadesMedida.update', session()->get('values') ?? ''] : 'unidadesMedida.store',
                'method' => session()->get('edit') == 1 ? 'PUT' : 'POST',
            ]) !!}
                <div class="col-md-12">

                    <div class="row justify-content-center">
                        <div class="col-md-5 ">
                            <div class="card">
                                <div class="card-header">
                                    <h4  class="font-weight-bolder">Unidades de Medida</h4>
                                </div>
                                <div class="card-body d-flex flex-column justify-content-around">

                                    <div class="form-group row">
                                        <div class="col-sm-3 col-form-label">
                                            <label class="col-form-label text-primary">Unidad *</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <div class="input-group input-group-merge">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-weight-hanging"></i></span>
                                                </div>
                                                {!! Form::text('unidadMedida', session()->get('values')->unidadMedida ?? '', [
                                                    'readonly' => session()->has('edit') ? (session()->get('edit') == 0 ? true : false) : false,
                                                    'class' => 'form-control pl-1',
                                                ]) !!}
                                            </div>
                                        </div>
                                        @error('unidadMedida')
                                            <small class="alert alert-danger ml-3 mt-1">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-3 col-form-label">
                                            <label class="col-form-label text-primary">Abreviación</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <div class="input-group input-group-merge">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-ruler-horizontal"></i></span>
                                                </div>
                                                {!! Form::text('abreviacion', session()->get('values')->abreviacion ?? '', [
                                                    'readonly' => session()->has('edit') ? (session()->get('edit') == 0 ? true : false) : false,
                                                    'class' => 'form-control pl-1',
                                                ]) !!}
                                            </div>
                                        </div>
                                        @error('abreviacion')
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
                        <div class="row d-flex justify-content-sm-around ">

                            <button class="btn btn-secondary" type="submit">
                                {{ session()->get('edit') ? 'Actualizar' : 'Crear' }}
                            </button>
                            <a href="{{ route('unidadesMedida.index') }}">
                                <div class="btn btn-danger">
                                    <i class="fas fa-ban mr-1"></i>
                                    Cancelar
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>

</div>
{{-- +  MODAL FIN CREATE --}}
