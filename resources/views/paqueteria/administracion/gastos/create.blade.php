@extends('layouts/contentLayoutMaster')

@section('title', 'File Uploader')

@section('vendor-style')
  <!-- vendor css files -->
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/file-uploaders/dropzone.min.css')) }}">
@endsection
@section('page-style')
  <!-- Page css files -->
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-file-uploader.css')) }}">
@endsection

@section('content')
    <!-- account setting page -->
    <section id="dropzone-examples">
        <div class="row d-flex justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="tab-content">
                            <!-- general tab -->
                            <div role="tabpanel" class="tab-pane active" id="account-vertical-general"
                                aria-labelledby="account-pill-general" aria-expanded="true">
                                <!-- form -->
                                
                                {!! Form::open([
                                  'route'  => 'gastos.store',
                                  'method' => 'POST',
                                  'files'  => true, 
                                  'enctype'=> "multipart/form-data"
                                ]) !!}   
                                    <div class="row">
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label for="account-username">Tipo gasto</label>
                                                <input type="text" class="form-control" id="account-username"
                                                    name="tipo_gasto" placeholder="" value="" required/>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label for="account-name">Monto del gasto </label>
                                                <div class="input-group input-group-merge">
                                                  <div class="input-group input-group-merge">
                                                      <div class="input-group-prepend">
                                                          <span class="input-group-text">MXN</span>
                                                      </div>
                                                      {!! Form::input('number', 'monto_gasto', '', [
                                                          'readonly' => session()->has('edit') ? (session()->get('edit') == 0 ? true : false) : false,
                                                          'min' => '0', 
                                                          'class' => 'form-control pl-1 cargo-logistica', 
                                                          'required' => true
                                                          
                                                      ]) !!}
                                                  </div>
                                                </div>
                                            </div>
                                            
                                        </div>                              
                                        
                                        <div class="media col-md-10">
                                          
                                            <div class="media-body mt-75 ml-1">                                          
                                                <div class="form-group">
                                                  <label for="customFile1">Comprobante de gasto</label>
                                                  <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="customFile1" required name="comprobante"/>
                                                    <label class="custom-file-label" for="customFile1">Seleccionar Archivo</label>
                                                  </div>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="col-12  d-flex justify-content-center">
                                            <button type="submit" class="btn btn-primary mt-2 mr-1">
                                                Guardar
                                            </button>

                                            <div class="mt-2">
                                                <a href="{{ route('gastos.create') }}">
                                                    <div class="btn btn-danger">
                                                        <i class="fas fa-ban mr-1"></i>
                                                        Cancelar
                                                    </div>
                                                </a>
                                            </div>
                                        </div>

                                    </div>
                                  
                                {!! Form::close() !!}
                                <!--/ form -->
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('vendor-script')
  <!-- vendor files -->
  <script src="{{ asset(mix('vendors/js/extensions/dropzone.min.js')) }}"></script>
@endsection
@section('page-script')
  <!-- Page js files -->
  <script src="{{ asset(mix('js/scripts/forms/form-file-uploader.js')) }}"></script>
@endsection
