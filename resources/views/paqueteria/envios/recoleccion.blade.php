@extends('layouts/contentLayoutMaster')
@section('title', 'Recoleccion')

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

<section class="recoleccion">
   
    @if (isset($message))
        
        <h4 class="text-danger">Error: {{$message}}</h4>
    @endif

    {!! Form::open([
        'route' => 'recoleccion.store',
        'method' => 'POST', 
    ]) !!}

    @include('paqueteria/envios/components/forms/recoleccion_form')
    <div class="col-12">
        <div class="card px-1">
            <div class="table-responsive">
                <table class="datatables-basic table">
                    <thead>
                        <tr>
                            <th scope="col">Sucursal</th>
                            <th scope="col">Paqueteria</th>
                            <th scope="col">Numero de guia</th>
                            <th scope="col">Status Envio</th>
                            <th scope="col">Status Recoleccion</th>
                            <th scope="col">Remitente</th>
                            <th scope="col">Destinatario</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
        
                </table>
            </div>
        </div>
    </div>
    

    <div class="col-md-12">
      
            <div class="row d-flex justify-content-sm-around mt-2">
                <button class="btn btn-success" type="submit">
                    {{ session()->get('edit') ? 'otra' : 'Recolectar' }}
                </button>
                <a href="{{ route('recoleccion.create') }}">
                    <div class="btn btn-danger">
                        <i class="fas fa-ban mr-1"></i>
                        Cancelar
                    </div>
                </a>
        </div>
    </div>

    {!! Form::close() !!}


</section>


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
  <script src="{{ asset(mix('js/scripts/envios/jquery.datetimepicker.full.min.js')) }}"></script>
  <script src="{{ asset(mix('js/scripts/catalogos/select2.min.js')) }}"></script>

  <script src="{{ asset(mix('js/scripts/catalogos/sucursales-search.js')) }}"></script>
  <script src="{{ asset(mix('js/scripts/envios/date-time-picker.js')) }}"></script>
  <script src="{{ asset(mix('js/scripts/envios/paquetes-recoleccion.js')) }}"></script>

@endsection

