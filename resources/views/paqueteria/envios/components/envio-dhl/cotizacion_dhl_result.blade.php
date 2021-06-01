{{-- RESULTADO FEDEX COTIZACION --}}

@if (session()->has('quoteResponse'))

    <div class="col-md-12">
        <div class="card">
            <div class="card-header">FEDEX COTIZACION</div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Linea de transporte</th>
                            <th>Fecha estimada</th>
                            <th>Detalles del envio</th>
                            <th>Costo Envio </th>
                            <th>Agregar</th>
                        </tr>
                    </thead>
                    <tbody>

                        @php
                            $qtdShps = session()->get('quoteResponse')['BkgDetails']['QtdShp'];
                        @endphp
                        
                        @foreach ($qtdShps as $qtdShp)
                            @if ( (float) $qtdShp['ShippingCharge'] > 0 )
                                
                                @php
                                    $globalProductCode = $qtdShp['GlobalProductCode'];
                                    $localProductCode = $qtdShp['LocalProductCode'];
                                    $nombreServicio = $qtdShp['ProductShortName'];
                                @endphp

                                <tr>

                                    <th>DHL</th>
                                    <th>{{$qtdShp['DeliveryDate']}}</th>
                                    <th style="color: red;">{{$nombreServicio}}</th>
                                    <th style="color: red;" id="{{$globalProductCode}}-monto"> {{$qtdShp['ShippingCharge']}}</th>
                                    <th>
                                        <div class="form-check bg-primary d-flex align-items-center">
                                            <input class="form-check-input" type="radio" name="global_product_code"
                                                id="{{ $globalProductCode }}"
                                                value="{{ $globalProductCode }}">
    
                                        </div>
    
                                    </th>

                                </tr>
                                {{-- <input type="hidden" name= "{{$globalProductCode}}_impuesto" value="{{$qtdShp['TotalTaxAmount']}}" id="{{$globalProductCode}}-tax"> --}}
                                <input type="hidden"  value="{{$qtdShp['TotalTaxAmount']}}" id="{{$globalProductCode}}-tax">
                                <input type="hidden"  value="{{$localProductCode}}" id="{{$globalProductCode}}-local">
                            @endif
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @include('paqueteria/envios/components/cotizacion_precios')
@endif

<small>{{ session()->get('rateReply')->Notifications[0]->Message ?? '' }}</small>
<small>{{ session()->get('successCotizacion') ?? '' }}</small>

@if (session()->get('successCotizacion') == 'FAILURE')

@endif
