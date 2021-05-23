@extends('layouts/contentLayoutMaster')

@section('title', 'Crear Envio')

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

<section class="envios">

    <div class="container envios-form">
        <div class="row d-flex justify-content-center">
            <div class="col-md-12">
                {{-- FORMULARIO DE COTIZACIONES  --}}
                {!! Form::open([
                    'route' => 'cotizar.cotizacion',
                    'method' => 'GET'
                ]) !!}

                @include('paqueteria/envios/forms/cotizacion_form')
                
                {!! Form::close() !!}

                {!! Form::open([
                    'route' => 'envios.store',
                    'method' => 'POST'
                ]) !!}
                
                @include('paqueteria/envios/components/cotizacion_result')
                @include('paqueteria/envios/forms/envios_form')
                
                {!! Form::close() !!}
                
                @include('paqueteria/envios/components/envio_result')



            </div>
        </div>
    </div>

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
  <script src="{{ asset(mix('js/scripts/envios/find-sucursal.js')) }}"></script>
  <script src="{{ asset(mix('js/scripts/envios/show-datos-envio.js')) }}"></script>

  <script src="{{ asset(mix('js/scripts/catalogos/select2.min.js')) }}"></script>
  <script src="{{ asset(mix('js/scripts/catalogos/sucursales-search.js')) }}"></script>
  <script src="{{ asset(mix('js/scripts/envios/sepomex-search.js')) }}"></script>
  <script src="{{ asset(mix('js/scripts/envios/remitentes-search.js')) }}"></script>
  <script src="{{ asset(mix('js/scripts/envios/destinatarios-search.js')) }}"></script>
  <script src="{{ asset(mix('js/scripts/envios/type-paquete.js')) }}"></script>
  
  

@endsection

