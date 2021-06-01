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
            

        </div>
    </div>
</div>
