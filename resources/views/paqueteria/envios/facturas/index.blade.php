@extends('layouts/contentLayoutMaster')
@section('title', 'Facturas')

@section('vendor-style')
    {{-- vendor css files --}}
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap4.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap4.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/buttons.bootstrap4.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/rowGroup.bootstrap4.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css')) }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('content')



{!! Form::open([
    'route'  => 'fac.store',
    'method' => 'POST',
    'files'  => true, 
    'enctype'=> "multipart/form-data"
]) !!}   

    <div class="col-md-12">
        <div class="row d-flex justify-content-center">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header"><h4>Facturas</h4></div>
                    <div class="card-body">
                        <div class="form-group">
                            {{ Form::select('paqueteria',[
                                'FEDEX' => 'FEDEX',
                                'DHL' => 'DHL',
                            ], 
                            session()->get('values')->paqueteria ?? '',[
                                'placeholder' => 'Seleccionar Paqueteria',
                                'readonly' => session()->has('values')
                                    ? (session()->get('edit') == 1 ? false : true )
                                    : false,
                                'class' => 'paqueteria form-control  col-md-12 pl-1', 

                            ])}}
                        </div>
                        <label for="upload_file" class="control-label col-sm-5">Seleccionar Archivo *XML</label>
                        <div class="form-group">
                                <div class="form-group mt-1">
                                    {{ Form::file('factura', [
                                        'accept' => '.xml, .csv'
                                    ])}}
                                </div>
                            <button class="btn btn-success" type="submit">
                                Subir
                            </button>
                        </div>
                    </div>
                </div>
            
            </div>
        </div>
    </div>
    

{!! Form::close() !!}

<div class="col-md-12">
    <div class="card px-1">
        <div class="table-responsive">
            <table class="datatables-basic table" id="facturas-table">
                <thead>
                    <tr>
                        <th scope="col">Paqueteria</th>
                        <th scope="col">Folio</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Precio Total</th>                       
                        <th scope="col">Acciones </th>
                    </tr>
                </thead>
    
            </table>
        </div>
    </div>
</div>



@endsection


@section('vendor-script')
    <script src="{{ asset(mix('vendors/js/tables/datatable/jquery.dataTables.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/datatables.bootstrap4.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.responsive.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/responsive.bootstrap4.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/datatables.checkboxes.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/datatables.buttons.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/jszip.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/pdfmake.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/vfs_fonts.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/buttons.html5.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/buttons.print.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.rowGroup.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/pickers/flatpickr/flatpickr.min.js')) }}"></script>


@endsection


@section('page-script')
  {{-- Page js files --}}
  <script src="{{ asset(mix('js/scripts/envios/facturas-table.js')) }}"></script>
  

@endsection

