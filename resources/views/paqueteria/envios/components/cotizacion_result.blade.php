{{-- RESULTADO FEDEX COTIZACION --}}

@if (session()->get('successCotizacion') == "SUCCESS" || session()->get('successCotizacion') == "WARNING")

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
                            <th>Costo Final </th>
                            <th>Agregar</th>
                        </tr>
                    </thead>
                    <tbody>

                        @php
                            $rateReplyDetails = session()->get('rateReply')->RateReplyDetails
                        @endphp

                        @foreach ($rateReplyDetails as $rateReplyDetail)

                            @php

                                $nombreServicio = $rateReplyDetail->ServiceType;
                                $montoEnvio = $rateReplyDetail->RatedShipmentDetails[1]->ShipmentRateDetail->TotalNetCharge->Amount ?? 'error';
                                $fechaEstimadaEnvio = $rateReplyDetail->DeliveryTimestamp ?? 'error';   

                            @endphp
                            {{-- {{$rateReplyDetail->ServiceType}} --}}
                            <tr>
                                <th>FEDEX</th>
                                <th>{{ $fechaEstimadaEnvio }}</th>
                                <th>{{ $rateReplyDetail->ServiceDescription->Names[1]->Value  }}</th>

                                <th id="{{$nombreServicio}}-monto">
                                    {{ $montoEnvio }}
                            
                                </th>

                                <th>
                                    <div class="form-check bg-primary d-flex align-items-center">
                                        <input class="form-check-input" type="radio" name="tipo_servicio"
                                            id="{{ $nombreServicio }}"
                                            value="{{ $nombreServicio }}">

                                    </div>

                                </th>
                            </tr>

                                {{-- @foreach ($rateReplyDetail->RatedShipmentDetails as $ratedShipmentDetail)
                                        @foreach ($ratedShipmentDetail->ShipmentRateDetail->Surcharges as $surcharge)
                                            <input type="hidden" value="{{$surcharge->Amount->Amount}}" id="{{$nombreServicio}}-fuel">
                                         @endforeach

                                    @foreach ($ratedShipmentDetail->ShipmentRateDetail->Taxes as $tax)
                                        <input type="hidden" value="{{$tax->Amount->Amount}}" id="{{$nombreServicio}}-tax">
                                    @endforeach
                                @endforeach --}}
                                @php
                                    $cargo = $rateReplyDetail->RatedShipmentDetails[1]->ShipmentRateDetail->Surcharges[0]->Amount->Amount;
                                    $impuesto = $rateReplyDetail->RatedShipmentDetails[1]->ShipmentRateDetail->Taxes[0]->Amount->Amount;
                                @endphp
                                    <input type="hidden" value="{{$cargo}}" id="{{$nombreServicio}}-fuel">
                                    <input type="hidden" value="{{$impuesto}}" id="{{$nombreServicio}}-tax">



                            @endforeach
                        </tbody>
                    </table>
            </div>
        </div>
    </div>
    @include('paqueteria/envios/components/cotizacion_precios')
@endif

@if (session()->get('successCotizacion') == "FAILURE")
    <div class="">
        <small class="text-danger">ERROR EN AL PETICION </small>
        <small>{{session()->get('rateReply')->Notifications[0]->Message }}</small>
    </div>
@endif
