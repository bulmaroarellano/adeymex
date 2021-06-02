<div class="container envios-form" id="envio-dhl" >
    <div class="row d-flex justify-content-center">
        <div class="col-md-12">
            {{-- FORMULARIO DE COTIZACIONES  --}}
            {!! Form::open([
                'route' => 'cotizar.cotizacion',
                'method' => 'GET'
            ]) !!}
         
            @include('paqueteria/envios/forms/cotizacion_envio_form')
            
            {!! Form::close() !!}
            
            {!! Form::open([
                'route' => 'envios.store',
                'method' => 'POST',
                'class' => 'enviar'
            ]) !!}                
            
            @include('paqueteria/envios/components/envio-dhl/cotizacion_dhl_result')
            @include('paqueteria/envios/forms/datos_envio_form')
            @include('paqueteria/envios/helpers/variables_envio_dhl')
            
            {!! Form::close() !!}

            {!! Form::open([
                'route' => 'pagos.store',
                'method' => 'POST',
                
            ]) !!}      
                {{session()->get('successEnvio')}}
                @if ( session()->get('successEnvio') == "Success")
                    @include('paqueteria/envios/components/envio-dhl/envio_dhl_result')
                    @include('paqueteria/envios/forms/pagos_form')
                    @include('paqueteria/envios/helpers/variables_pago')                    
                @endif

                @if (session()->get('successEnvio') == "Failure")
                    <div class="">
                        <small class="text-warning">Error al realizar el envio</small>
                        {{-- <small class="">{{session()->get('processShipmentReply')->Notifications[0]->Message }}</small> --}}
                    </div>
                @endif

            {!! Form::close() !!}

        </div>
    </div>
</div>
