@if (session()->has('quoteResponse'))

    @php
        $qtdShps = session()->get('quoteResponse')['BkgDetails']['QtdShp'] ?? session()->get('quoteResponse');
    @endphp
    @if ($qtdShps != 'Error')
        @foreach ($qtdShps as $qtdShp)

            @php
                $globalProductCode = $qtdShp['GlobalProductCode'] ?? 'Error en la solicitud';
                $localProductCode  = $qtdShp['LocalProductCode']  ?? 'Error en la solicitud';
                $nombreServicio    = $qtdShp['ProductShortName']  ?? 'Error en la solicitud';
                $costoEnvio = $qtdShp['ShippingCharge'] ?? 0;
            @endphp

            @if ( ( (float) $costoEnvio > 0 ) && !($nombreServicio == 'DOMESTICO ENVIO RETORNO' || $nombreServicio == 'EXPRESS DOMESTIC 12:00' || $nombreServicio == 'EXPRESS 12:00'))
                <tr>

                    <th id="{{ $globalProductCode }}-paqueteria">DHL</th>
                    <th>{{ $qtdShp['DeliveryDate']['DlvyDateTime'] }}</th>
                    <th>{{ $nombreServicio }}</th>
                    {{-- <th id="{{ $globalProductCode }}-monto"> {{ $qtdShp['ShippingCharge'] }}</th> --}}
                    <th id="{{ $globalProductCode }}-monto"> {{ $qtdShp['QtdSInAdCur'][1]['TotalAmount'] }}
                        {{ $qtdShp['QtdSInAdCur'][1]['CurrencyCode'] }}</th>
                    <th>

                            <input type="radio" name="paqueteria_code"
                                id="{{ $globalProductCode }}" value="{{ $globalProductCode }}">



                    </th>

                </tr>
                {{-- <input type="hidden" name= "{{$globalProductCode}}_impuesto" value="{{$qtdShp['TotalTaxAmount']}}" id="{{$globalProductCode}}-tax"> --}}
                <input type="hidden" value="{{ $qtdShp['QtdSInAdCur'][1]['TotalTaxAmount'] }}"
                    id="{{ $globalProductCode }}-tax">
                <input type="hidden" value="{{ $localProductCode }}" id="{{ $globalProductCode }}-local">
            @endif
        @endforeach
    @endif

    @if ($qtdShps == 'Error')
        <strong class="text-danger">DHL : No disponible </strong>
    @endif
@endif
