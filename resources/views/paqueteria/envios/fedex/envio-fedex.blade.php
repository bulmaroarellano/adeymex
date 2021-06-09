<div class="container envios-form" id="envio-fedex" >
    <div class="row d-flex justify-content-center">
        <div class="col-md-12">
            
            {!! Form::open([
                'route' => 'envios.store',
                'method' => 'POST',
                'class' => 'enviar'
            ]) !!}                
            
    
            
            @include('paqueteria/envios/helpers/variables_envio_fedex')
            
            
            {!! Form::close() !!}
            
            {!! Form::open([
                'route' => 'pagos.store',
                'method' => 'POST',
                
            ]) !!}      

            @if (session()->get('successEnvio') == "SUCCESS" || session()->get('successEnvio') == "WARNING" || session()->get('successEnvio') == "NOTE")
                @include('paqueteria/envios/fedex/envio_fedex_result')
                @include('paqueteria/envios/components/forms/pagos_form')
                @include('paqueteria/envios/helpers/variables_pago')
            @endif

            @if (session()->get('successEnvio') == "FAILURE")
                <div class="">
                    <small class="text-warning">Error al realizar el envio</small>
                    <small class="">{{session()->get('processShipmentReply')->Notifications[0]->Message }}</small>
                </div>
            @endif
            
            {!! Form::close() !!}
            

        </div>
    </div>
</div>
