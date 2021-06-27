
@php
    $success = session()->get('successEnvio');
    $envio = session()->get('nuevoEnvio');
@endphp


@if ( !( $success == "ERROR" ) && ( $envio->paqueteria == "FEDEX" ) )
    @include('paqueteria/envios/fedex/envio_fedex_result')
@endif
    

@if ( ( $success == "Success" ) && (  $envio->paqueteria == "DHL" ) )
    @include('paqueteria/envios/dhl/envio_dhl_result')
@endif
