@php
    $tipoServicio = session()->get('requestShipment')['ProductShortName'];
    $numeroGuia = session()->get('requestShipment')['AirwayBillNumber'];
    $urlGuia = session()->get('urlGuia');
    $precios = session()->get('precios');
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
                {{-- <li>Costo Envio {{$precios->costo_sucursal_envio}}</li> --}}
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
