@if (session()->get('successEnvio') == "SUCCESS" || session()->get('successEnvio') == "WARNING")

    @php
        $tipoServicio = session()->get('processShipmentReply')->CompletedShipmentDetail->ServiceDescription->ServiceType ;
        $numeroGuia = session()->get('processShipmentReply')->CompletedShipmentDetail->MasterTrackingId->TrackingNumber ;
        $urlGuia = session()->get('urlGuia') ;
        $precios = session()->get('precios') ;
    @endphp

    <ul>
        <li>Tipo de envio  {{$tipoServicio}}</li>
        <li>NUmero de guia {{$numeroGuia}}</li>
    </ul>

    <div class="container">
        <div class="card">
            <div class="card-header">Costo Total</div>
            <div class="card-body">
                <ul>
                    <li>Cargos {{$precios->cargos_envio}}</li>
                    <li>Impuestos {{$precios->impuestos_envio}}</li>
                    <li>Cargo Logistica Interna {{$precios->cargo_logistica_interna}}</li>
                    <li>Total a pagar {{$precios->precio_total_sucursal}}</li>
                </ul>

                <a href="{{$urlGuia}}" download>
                    <button>Download PDF {{$urlGuia}}</button>
                </a>
            </div>
        </div>
    </div>
    
@endif

@if (session()->get('successEnvio') == "FAILURE")
    
    <div class="">
        <small class="text-warning">Error al realizar el envio</small>
        <small class="">{{session()->get('processShipmentReply')->Notifications[0]->Message }}</small>
        
    </div>

@endif