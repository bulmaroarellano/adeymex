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
{{-- COTIZAR-ENVIO --}}
{{-- COTIZAR-RESULT  --}}
{{-- COTIZACION-PRECIOS --}}

<section class="envio">
    <h3 class="paqueteria-selec ml-1">Selecciona una paqueteria</h3>
    {!! Form::open([
      'route' => 'envios.paqueteria',
      'method' => 'GET'
    ]) !!}
      <div class="container mb-1">
          <div class="row d-flex justify-content-center">
              <div class="btn-group btn-group-toggle btn-group btn-group-lg" data-toggle="buttons">
              
                  <label class="btn btn-secondary active">
                    <input type="radio" name="paqueteria" id="paqueteria-fedex" value="fedex" 
                      autocomplete="off" onchange="this.form.submit();"
                      {{session()->get('paqueteria') == 'fedex' ? 'checked' : '' }}
                    > 
                    
                    FEDEX
                  </label>
                
                  <label class="btn btn-secondary">
                    <input type="radio" name="paqueteria" id="paqueteria-dhl" value="dhl" 
                      autocomplete="off" onchange="this.form.submit();"
                      {{session()->get('paqueteria') == 'dhl' ? 'checked' : '' }}
                    >
                    DHL
                  </label>
                
                  <label class="btn btn-secondary">
                    <input type="radio" name="paqueteria" id="paqueteria-ups" value="ups" 
                      autocomplete="off" onchange="this.form.submit();"
                      {{session()->get('paqueteria') == 'ups' ? 'checked' : '' }}
                    > 
                    UPS
                  </label>
                
              </div>
          </div>
      </div>
    {!! Form::close() !!}
    
    @if (session()->get('paqueteria') == 'fedex')
      @include('paqueteria/envios/components/envio-fedex/envio-fedex')    
    @endif
    
    @if (session()->get('paqueteria') == 'dhl')
      @include('paqueteria/envios/components/envio-dhl/envio-dhl')    
    @endif

    @if (session()->get('paqueteria') == 'ups')
      @include('paqueteria/envios/components/envio-ups/envio-ups')    
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
  <script src="{{ asset(mix('js/scripts/envios/envio.js')) }}"></script>

  <script src="{{ asset(mix('js/scripts/envios/find-sucursal.js')) }}"></script>
  <script src="{{ asset(mix('js/scripts/envios/guardar-datos-envio.js')) }}"></script>

  <script src="{{ asset(mix('js/scripts/catalogos/select2.min.js')) }}"></script>
  <script src="{{ asset(mix('js/scripts/catalogos/sucursales-search.js')) }}"></script>
  <script src="{{ asset(mix('js/scripts/envios/sepomex-search.js')) }}"></script>
  <script src="{{ asset(mix('js/scripts/envios/remitentes-search.js')) }}"></script>
  <script src="{{ asset(mix('js/scripts/envios/destinatarios-search.js')) }}"></script>
  <script src="{{ asset(mix('js/scripts/envios/tipo-paquete-valores.js')) }}"></script>
  
  

@endsection

