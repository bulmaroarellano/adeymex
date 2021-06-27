
@php
    $precios = session()->get('precios') ;
    $nombrePaqueteria = session()->get('paqueteria');
    $nuevoEnvio = session()->get('nuevoEnvio');
    $suministros = session()->get('suministros');
@endphp

<input type="hidden" name="costo_sucursal_envio"      value="{{$precios->costo_sucursal_envio}}" id="costo-sucursal-envio" >
{{-- <input type="hidden" name="costo_publico_envio"       value="{{$precios->costo_publico_envio}}" id="costo-publico-envio" > --}}

<input type="hidden" name="impuestos_envio"           value="{{$precios->impuestos_envio}}" id="impuestos-envio" >
<input type="hidden" name="cargo_logistica_interna"  value="{{$precios->cargo_logistica_interna}}" id="cargos-logistica-interna" >
<input type="hidden" name="precio_total_sucursal"     value="{{$precios->precio_total_sucursal}}" id="precio-total-sucursal" >
<input type="hidden" name="nuevo_envio"     value="{{$nuevoEnvio}}" id="nuevo-envio" >


<input type="hidden" name="cargos_envio" value="{{$precios->cargos_envio}}" id="cargos-envio">    

<input type="hidden" name="suministros" value="{{$suministros}}" id="suministros">    


