{{-- DATOS GENERALES --}}
<input type="hidden" name="sucursal_id"  value="" id="sucursal-id-envio" >
<input type="hidden" name="id_cp_destinatario"  value="" id="id-cp-destinatario" >
<input type="hidden" name="nombre_paqueteria"  value="" id="nombre-paqueteria" >
<input type="hidden" name="country_code"  value="" id="country-code" >
{{-- <input type="hidden" name="seguro_envio"  value="" id="seguro-envio" > --}}


{{-- COSTOS E IMPUESTOS --}}
<input type="hidden" name="costo_sucursal_envio"  value="" id="costo-sucursal-envio">
<input type="hidden" name="cargo_logistica_interna"  value="" id="cargo-logistica">
<input type="hidden" name="precio_envio_total"  value="" id="precio-envio-total">

{{-- SOLO PARA FEDEX --}}
<input type="hidden" name="cargos_envio"  value="" id="cargos-envio"> 
{{-- SOLO PARA DHL --}}
<input type="hidden" name="impuestos_envio"  value="" id="impuestos-envio">

{{-- VARIANTE CODIGO ENVIO  --}}

{{-- <input type="hidden" name="type_paquete_fedex"  value="" id="type-paquete-fedex"> --}}
<input type="hidden" name="local_product_code"  value="" id="local-product-code">
{{-- <input type="hidden" name="service_code"  value="" id="service-code"> --}}

{{-- PAQUETE --}}

@if ( session()->has('type_paquete') )

    @php
        $largo = session()->get('largo');
        $ancho = session()->get('ancho');
        $alto = session()->get('alto');
        $peso = session()->get('peso');
        $tipoPaquete = session()->get('type_paquete');
    @endphp

    @foreach ($tipoPaquete as $key => $paquete)

        {{-- PAQUETE --}}
        <input type="hidden" name="largo_paquete[]" value="{{$largo[$key]}}" id="largo-paquete" >
        <input type="hidden" name="ancho_paquete[]" value="{{$ancho[$key]}}" id="ancho-paquete" >
        <input type="hidden" name="alto_paquete[]"  value="{{$alto[$key]}}" id="alto-paquete" >
        <input type="hidden" name="peso_paquete[]"  value="{{$peso[$key]}}" id="peso-paquete" >
        <input type="hidden" name="type_paquete[]"  value="{{$paquete}}" id="type-paquete">
        
    @endforeach
    
    
@endif




