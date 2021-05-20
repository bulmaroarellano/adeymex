{{-- RESULTADO FEDEX COTIZACION --}}

@if (!empty(session()->get('rateReplyDetails')))

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

                        @foreach (session()->get('rateReplyDetails') as $rateReplyDetail)

                            @php
                                $nombreEnvio = str_replace(' ', '',$rateReplyDetail->ServiceDescription->Names[1]->Value);
                                $montoEnvio = $rateReplyDetail->RatedShipmentDetails[1]->ShipmentRateDetail->TotalNetCharge->Amount;
                                $fechaEstimadaEnvio = $rateReplyDetail->DeliveryTimestamp;   
                            @endphp

                            <tr>
                                <th>FEDEX</th>
                                <th>{{ $fechaEstimadaEnvio }}</th>
                                <th>{{ $rateReplyDetail->ServiceDescription->Names[1]->Value  }}</th>

                                <th>
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
                    <input type="hidden" name="type_paquete_fedex"  value="" id="type-paquete-fedex" >
                    <input type="hidden" name="largo_paquete" value="" id="largo-paquete-fedex" >
                    <input type="hidden" name="ancho_paquete" value="" id="ancho-paquete-fedex" >
                    <input type="hidden" name="alto_paquete"  value="" id="alto-paquete-fedex" >
                    <input type="hidden" name="peso_paquete"  value="" id="peso-paquete-fedex" >

            </div>
        </div>
    </div>
@endif
