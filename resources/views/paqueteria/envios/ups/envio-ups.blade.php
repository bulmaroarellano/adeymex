<div class="container envios-form" id="envio-dhl" >
    <div class="row d-flex justify-content-center">
        <div class="col-md-12">
            {{-- FORMULARIO DE COTIZACIONES  --}}
            {!! Form::open([
                'route' => 'envios.store',
                'method' => 'POST',
                'class' => 'enviar'
            ]) !!}                
            
        
            @include('paqueteria/envios/helpers/variables_envio_ups')
            
            {!! Form::close() !!}


        </div>
    </div>
</div>
