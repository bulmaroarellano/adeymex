@if (session()->has('rateReply') && session()->has('quoteResponse') && session()->has('rateResponse'))
    <div class="col-md-12 mt-2">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"></div>
                    <div class="card-body">

                        <div class="table-responsive">
                            <table class="table ">
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
                                    @include('paqueteria/envios/fedex/cotizacion_fedex_result')
                                    @include('paqueteria/envios/dhl/cotizacion_dhl_result')
                                    @include('paqueteria/envios/ups/cotizacion_ups_result')
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 my-auto">
                @include('paqueteria/envios/components/cotizacion_precios')
            </div>
        </div>
    </div>
    
@else
    @if (session()->has('rateReply') && session()->has('quoteResponse'))


        <div class="col-md-12 mt-2">
            <div class="row ">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header"></div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table ">
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
                                        @include('paqueteria/envios/fedex/cotizacion_fedex_result')
                                        @include('paqueteria/envios/dhl/cotizacion_dhl_result')
                                        {{-- @include('paqueteria/envios/ups/cotizacion_ups_result') --}}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 my-auto">
                    @include('paqueteria/envios/components/cotizacion_precios')
                </div>
            </div>
        </div>
    @endif

@endif
