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
                                $nombreEnvio = str_replace(' ', '',$rateReplyDetail->ServiceDescription->Names[1]->Value ??  'no');
                                $montoEnvio = $rateReplyDetail->RatedShipmentDetails[1]->ShipmentRateDetail->TotalNetCharge->Amount ?? 'no';
                                $fechaEstimadaEnvio = $rateReplyDetail->DeliveryTimestamp ?? 'no';   
                            @endphp

                            <tr>
                                <th>FEDEX</th>
                                <th>{{ $fechaEstimadaEnvio }}</th>
                                <th>{{ $rateReplyDetail->ServiceDescription->Names[1]->Value  }}</th>

                                <th id="{{$nombreEnvio}}-monto">
                                    {{ $montoEnvio }}
                            
                                </th>

                                <th>
                                    <div class="form-check bg-primary d-flex align-items-center">
                                        <input class="form-check-input" type="radio" name="nombreEnvio"
                                            id="{{ $nombreEnvio }}"
                                            value="{{ $nombreEnvio }}">

                                    </div>

                                </th>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <input type="hidden" name="sucursal_id"  value="" id="sucursal_id_envio" >
                    <input type="hidden" name="type_paquete_fedex"  value="" id="type-paquete-fedex" >
                    <input type="hidden" name="largo_paquete" value="" id="largo-paquete-fedex" >
                    <input type="hidden" name="ancho_paquete" value="" id="ancho-paquete-fedex" >
                    <input type="hidden" name="alto_paquete"  value="" id="alto-paquete-fedex" >
                    <input type="hidden" name="peso_paquete"  value="" id="peso-paquete-fedex" >
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
