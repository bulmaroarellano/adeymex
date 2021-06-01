<div class="col-md-12">
    <div class="row d-flex justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
        
                    <h4 class="font-weight-bolder">Desglose de costos </h4>
                </div>
                <div class="card-body">
                    <div class="container ">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Concepto</th>
                                    <th scope="col">Precio</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (session()->get('paqueteria') == 'fedex')
                                    <tr>
                                        <th>Costo Envio Fedex</th>
                                        <th id="precio-envio-fedex"></th>
                                    </tr>
                                    <tr>
                                        <th>Cargo por combustible</th>
                                        <th id="precio-cargo-combustible"></th>
                                    </tr>
                                    <tr>
                                        <th>Impuestos</th>
                                        <th id="precio-impuestos"></th>
                                    </tr>
                                    <tr>
                                        <th>Cargo por logistica Interna</th>
                                        <th id="precio-logistica-interna"></th>
                                    </tr>
                                    <tr>
                                        <th class="text-danger">Precio Total</th>
                                        <th id="precio-total"></th>
                                    </tr>
                                @endif

                                @if (session()->get('paqueteria') == 'dhl')
                                    <tr>
                                        <th>Costo Envio DHL</th>
                                        <th id="precio-envio-dhl"></th>
                                    </tr>
                                    <tr>
                                        <th>Impuestos</th>
                                        <th id="precio-impuestos"></th>
                                    </tr>
                                    <tr>
                                        <th>Cargo por logistica Interna</th>
                                        <th id="precio-logistica-interna"></th>
                                    </tr>
                                    <tr>
                                        <th class="text-danger">Precio Total</th>
                                        <th id="precio-total"></th>
                                    </tr>
                                @endif

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
