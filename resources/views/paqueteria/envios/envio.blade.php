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

<section class="envio">
    
    {!! Form::open([
      'route' => 'cotizar.cotizacion',
      'method' => 'GET', 
      // 'id' => 'cotizar', 
    ]) !!}

      @include('paqueteria/envios/components/forms/cotizacion_envio_form')    
    
    {!! Form::close() !!}

          

    {!! Form::open([
      'route' => 'envios.store',
      'method' => 'POST',
      'class' => 'enviar'
    ]) !!}    

      @include('paqueteria/envios/components/cotizaciones')
      
      @if (session()->has('countryCode') && ! ( session()->get('countryCode') == "MX" ) )  
        
        @include('paqueteria/envios/components/data_international')  

      @endif

      
      <div class="col-md-12 mt-2">
        <div class="row">
          @include('paqueteria/envios/components/suministros')
          @include('paqueteria/envios/components/valores_asegurados')
  
        </div>
      </div>
      @include('paqueteria/envios/components/forms/datos_envio_form')
      @include('paqueteria/envios/helpers/variables_envio')

    {!! Form::close() !!}
    
    
    @if (session()->has('nuevoEnvio'))
      
      @include('paqueteria/envios/components/envio_result')  
    
      {!! Form::open([
        'route' => 'pagos.store',
        'method' => 'POST',
      ]) !!}   

        @include('paqueteria/envios/components/forms/pagos_form')
        @include('paqueteria/envios/helpers/variables_pago') 
      
      {!! Form::close() !!}

    @endif

    @if (session()->has('ticket'))
      @include('paqueteria/envios/components/forms/pagos_form')
    @endif

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
  <script src="{{ asset(mix('js/scripts/envios/guardar-datos-envio.js')) }}"></script>
  <script src="{{ asset(mix('js/scripts/envios/add-package.js')) }}"></script>
  
  <script src="{{ asset(mix('js/scripts/catalogos/select2.min.js')) }}"></script>
  
  <script src="{{ asset(mix('js/scripts/catalogos/sucursales-search.js')) }}"></script>
  <script src="{{ asset(mix('js/scripts/envios/zips-search.js')) }}"></script>
  <script src="{{ asset(mix('js/scripts/envios/remitentes-search.js')) }}"></script>
  <script src="{{ asset(mix('js/scripts/envios/destinatarios-search.js')) }}"></script>
  <script src="{{ asset(mix('js/scripts/envios/ocurre-search.js')) }}"></script>

  <script src="{{ asset(mix('js/scripts/envios/jquery.validate.min.js')) }}"></script>
  

  <script src="{{ asset(mix('js/scripts/envios/tipo-paquete-valores.js')) }}"></script>
  <script src="{{ asset(mix('js/scripts/envios/valores-asegurados.js')) }}"></script>
  
  

@endsection

