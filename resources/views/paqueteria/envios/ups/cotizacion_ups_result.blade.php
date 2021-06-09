@php
$rateResponse = session()->get('rateResponse');

@endphp

@foreach ($rateResponse as $ratedShipments)
    @foreach ($ratedShipments as $ratedShipment)
        <tr>
            <th id="{{$ratedShipment->Service->getCode()}}-paqueteria">UPS</th>
            <th></th>
            <th>{{ $ratedShipment->Service->getName() }}</th>
            <th id="{{ $ratedShipment->Service->getCode() }}-monto">
                {{ $ratedShipment->TransportationCharges->MonetaryValue }}
                {{ $ratedShipment->TransportationCharges->CurrencyCode }}
            </th>
            <th>
                <div class="form-check bg-primary d-flex align-items-center">
                    {{-- <input class="form-check-input" type="radio" name="service_code" --}}
                    <input class="form-check-input" type="radio" name="paqueteria_code"
                        id="{{ $ratedShipment->Service->getCode() }}"
                        value="{{ $ratedShipment->Service->getCode() }}">

                </div>
            </th>

        </tr>
    @endforeach
@endforeach


