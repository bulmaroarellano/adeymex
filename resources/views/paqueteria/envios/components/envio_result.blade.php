@if (session()->get('successEnvio') == "SUCCESS" || session()->get('successEnvio') == "WARNING")

    

    
@endif

@if (session()->get('successEnvio') == "FAILURE")
    
    <div class="">
        <small class="text-warning">Error al realizar el envio</small>
        <small class="">{{session()->get('processShipmentReply')->Notifications[0]->Message }}</small>
        
    </div>

@endif