{{-- RESULTADO FEDEX COTIZACION --}}

@if (session()->has('rateResponse'))

    <div class="col-md-12">
        <div class="card">
            <div class="card-header">UPS COTIZACION</div>
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
                            $rateResponse = session()->get('rateResponse');
                            
                        @endphp

                        @foreach ($rateResponse as $ratedShipments)
                            @foreach ($ratedShipments as $ratedShipment)
                                <tr>
                                    <th>UPS</th>
                                    <th></th>
                                    <th>{{$ratedShipment->Service->getName()}}</th>
                                    <th style="color: red;" id="{{$ratedShipment->Service->getCode()}}-monto">{{$ratedShipment->TransportationCharges->MonetaryValue}}</th>
                                    <th>
                                        <div class="form-check bg-primary d-flex align-items-center">
                                            <input class="form-check-input" type="radio" name="service_code"
                                                id="{{ $ratedShipment->Service->getCode() }}"
                                                value="{{ $ratedShipment->Service->getCode() }}">
    
                                        </div>
                                    </th>

                                </tr>
                                 
                             
                            @endforeach
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
