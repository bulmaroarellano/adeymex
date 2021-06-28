
@php
    $precios = session()->get('precios') ;
    $nombrePaqueteria = session()->get('paqueteria');
    $nuevoEnvio = session()->get('nuevoEnvio');
    $suministros = session()->get('suministros');
    
@endphp



<input type="hidden" name="precios"     value="{{$precios}}" id="nuevo-envio" >

<input type="hidden" name="nuevo_envio"     value="{{$nuevoEnvio}}" id="nuevo-envio" >

<input type="hidden" name="suministros" value="{{$suministros}}" id="suministros">    
 


