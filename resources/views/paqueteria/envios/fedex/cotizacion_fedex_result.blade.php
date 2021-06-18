
@php
    $rateReplyDetails = session()->get('rateReply')->RateReplyDetails;
    $success = session()->get('rateReply')->HighestSeverity;
@endphp

@if ( ! ($success == "FAILURE") )


    @foreach ($rateReplyDetails as $rateReplyDetail)

        @php
            $nombreServicio = $rateReplyDetail->ServiceType;
            $montoEnvio = $rateReplyDetail->RatedShipmentDetails[1]->ShipmentRateDetail->TotalNetCharge->Amount ?? 'error';
            $fechaEstimadaEnvio = $rateReplyDetail->DeliveryTimestamp ?? 'error';   
        @endphp
    
        <tr>
            <th id="{{$nombreServicio}}-paqueteria">FEDEX</th>
            <th>{{ $fechaEstimadaEnvio }}</th>
            <th>{{ $rateReplyDetail->ServiceDescription->Names[1]->Value  }}</th>
            <th id="{{$nombreServicio}}-monto"> {{ $montoEnvio }}</th>

            <th>
                <div class="form-check bg-primary d-flex align-items-center">
                    {{-- <input class="form-check-input" type="radio" name="tipo_servicio" --}}
                    <input class="form-check-input" type="radio" name="paqueteria_code"
                                            id="{{ $nombreServicio }}"
                                            value="{{ $nombreServicio }}">

                </div>
            </th>
        </tr>
        @php
            $cargo = $rateReplyDetail->RatedShipmentDetails[1]->ShipmentRateDetail->Surcharges[0]->Amount->Amount ?? 'error';
            $impuesto = $rateReplyDetail->RatedShipmentDetails[1]->ShipmentRateDetail->Taxes[0]->Amount->Amount ?? 'error';
        @endphp
            <input type="hidden" value="{{$cargo}}" id="{{$nombreServicio}}-fuel">
            <input type="hidden" value="{{$impuesto}}" id="{{$nombreServicio}}-tax">

    @endforeach

@endif

<small>{{session()->get('rateReply')->Notifications[0]->Message ?? ''}}</small>
<small>{{$success ?? ''}}</small>

@if ($success == "FAILURE")
    <div class="">
        <small class="text-danger">ERROR EN AL PETICION </small>
        <small>{{session()->get('rateReply')->Notifications[0]->Message }}</small>
        
    </div>
@endif
