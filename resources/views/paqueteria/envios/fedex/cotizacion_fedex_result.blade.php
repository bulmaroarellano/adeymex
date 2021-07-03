
@php
    $rateReplyDetails = session()->get('rateReply')->RateReplyDetails ??[];
    $success = session()->get('rateReply')->HighestSeverity;
@endphp

@if ( ! ($success == "FAILURE") )


    @foreach ($rateReplyDetails as $rateReplyDetail)

        @php
            

            try {
                $nombreServicio = $rateReplyDetail->ServiceType ?? 'ERROR';
                // $montoEnvio = $rateReplyDetail->RatedShipmentDetails[1]->ShipmentRateDetail->TotalNetCharge->Amount ?? 'error';
                // $montoEnvio = $rateReplyDetail->RatedShipmentDetails[1]->ShipmentRateDetail->TotalNetFedExCharge->Amount ?? 'error';
                $montoEnvio = $rateReplyDetail->RatedShipmentDetails[1]->ShipmentRateDetail->TotalBaseCharge->Amount ?? 'No disponible';
                $fechaEstimadaEnvio = $rateReplyDetail?->DeliveryTimestamp ?? 'error';   
            } catch (\Throwable $th) {
                
            }
        @endphp
    
        <tr>
            <th id="{{$nombreServicio}}-paqueteria">FEDEX</th>
            <th>{{ $fechaEstimadaEnvio ?? 'No Disponible'}}</th>
            <th>{{ $rateReplyDetail->ServiceDescription->Names[1]->Value  }}</th>
            <th id="{{$nombreServicio}}-monto"> {{ $montoEnvio }}</th>

            <th>
                <input  type="radio" name="paqueteria_code" id="{{ $nombreServicio }}" value="{{ $nombreServicio }}">
            </th>
        </tr>
        @php
            $cargo = $rateReplyDetail->RatedShipmentDetails[1]->ShipmentRateDetail->Surcharges[0]->Amount->Amount ?? 'error';
            $impuesto = $rateReplyDetail->RatedShipmentDetails[1]->ShipmentRateDetail->Taxes[0]->Amount->Amount ?? 'error';
        @endphp
            <input type="hidden" value="{{$cargo}}" id="{{$nombreServicio}}-fuel">
            <input type="hidden" value="{{$impuesto}}" id="{{$nombreServicio}}-tax">

    @endforeach

    @if (count($rateReplyDetails) == 0 )
        <small class="text-danger">FEDEX:</small>
        <small class="text-danger">{{session()->get('rateReply')->Notifications[0]->Message }}</small>
    @endif

@endif

@if ($success == "FAILURE")
    <div class="">
        <small class="text-danger">FEDEX:</small>
        <small class="text-danger">{{session()->get('rateReply')->Notifications[0]->Message }}</small>
    </div>
@endif
