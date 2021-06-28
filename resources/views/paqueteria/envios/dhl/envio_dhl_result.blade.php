@php
    $tipoServicio = session()->get('nuevoEnvio')->tipo_servicio ;
    $numeroGuia   = session()->get('nuevoEnvio')->master_guia ;
    $urlGuia      = session()->get('nuevoEnvio')->url_master_guia ;
    $invoice      = session()->get('invoice');
    $precios      = json_decode(session()->get('precios')) ;
@endphp

<div class="col-md-12">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3>Informacion del envio  </h3>
                </div>
                <div class="card-body">
                    <ul>
                        <li>Tipo de envio  {{$tipoServicio}}</li>
                        <li>NUmero de guia {{$numeroGuia}}</li>
                    </ul>
                    <div class="row d-flex justify-content-around">

                        <a href="{{$urlGuia}}" download>
                            <button class="btn btn-danger">
                                Guia
                                <i class="fas fa-file-pdf fa-lg"></i>
                            </button>
                        </a>
                        
                        @if (  ! is_null($invoice) )

                            <a href="{{$invoice->url_invoice_guia}}" download>
                                <button class="btn btn-danger">
                                    Commercial-Invoice
                                    <i class="fas fa-file-pdf fa-lg"></i>
                                </button>
                            </a>

                        @endif  

                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3>Total a pagar</h3>
                </div>
                <div class="card-body">
                    <ul>
                        <li>Costo Envio {{$precios->costo_sucursal_envio}}</li>
                        <li>Cargos:    {{ $precios->cargos_envio    }}</li>
                        <li>Impuestos: {{ $precios->impuestos_envio }}</li>
                        <li>Cargo Logistica Interna: {{$precios->cargo_logistica_interna }}</li>
                        <li>Valor Asegurado: {{$precios->seguro_envio }}</li>
                        <li>Suministros: {{$precios->suministros_precio_total ?? '0'}}</li>
                        <li>Total a pagar: {{$precios->precio_total_sucursal }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>