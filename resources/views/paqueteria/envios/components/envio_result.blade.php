@if (session()->get('successEnvio') == "SUCCESS" || session()->get('successEnvio') == "WARNING")

    @php
        $tipoServicio = session()->get('processShipmentReply')->CompletedShipmentDetail->ServiceDescription->ServiceType ;
        $numeroGuia = session()->get('processShipmentReply')->CompletedShipmentDetail->MasterTrackingId->TrackingNumber ;
    @endphp

    <ul>
        <li>Tipo de envio  {{$tipoServicio}}</li>
        <li>NUmero de guia {{$numeroGuia}}</li>
    </ul>
    

    
@endif

@if (session()->get('successEnvio') == "FAILURE")
    
    <div class="">
        <small class="text-warning">Error al realizar el envio</small>
        <small class="">{{session()->get('processShipmentReply')->Notifications[0]->Message }}</small>
        
    </div>

@endif