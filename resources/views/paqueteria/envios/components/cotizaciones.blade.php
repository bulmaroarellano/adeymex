


@if (session()->has('rateReply') && session()->has('quoteResponse') && session()->has('rateResponse'))
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header"></div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
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
                                        @include('paqueteria/envios/fedex/cotizacion_fedex_result')
                                        @include('paqueteria/envios/dhl/cotizacion_dhl_result')
                                        @include('paqueteria/envios/ups/cotizacion_ups_result')
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-4">
                                <input type="text">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-2 my-auto">
                <div class="card ">
                    <div class="card-header"><h5>Valor asegurado</h5></div>
                    <div class="card-body align-self-center">
                        <input type="number" class="form-control" name="seguro_envio" value="0">
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('paqueteria/envios/components/cotizacion_precios')
@else
    @if (session()->has('rateReply') && session()->has('quoteResponse'))


        <div class="col-md-12">
            <div class="row ">
                <div class="col-md-10">
                    <div class="card">
                        <div class="card-header"></div>
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
                                    @include('paqueteria/envios/fedex/cotizacion_fedex_result')
                                    @include('paqueteria/envios/dhl/cotizacion_dhl_result')
                                    {{-- @include('paqueteria/envios/ups/cotizacion_ups_result') --}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 my-auto">
                    <div class="card ">
                        <div class="card-header"><h5>Valor asegurado</h5></div>
                        <div class="card-body align-self-center">
                            <input type="number" class="form-control" name="seguro_envio" value="0">
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        
        @include('paqueteria/envios/components/cotizacion_precios')

    @endif
    
@endif

    