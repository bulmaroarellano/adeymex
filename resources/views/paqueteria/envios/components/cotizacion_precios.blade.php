<div class="col-md-12">
    <div class="row d-flex justify-content-around">
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">
                    <h4 class="font-weight-bolder">Desglose de costos envio</h4>
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
                            <tbody id="FEDEX" style="display: none">
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
                            </tbody>

                            <tbody id="DHL" style="display: none">
                                <tr>
                                    <th>Costo Envio DHL</th>
                                    <th id="precio-envio-dhl"></th>
                                </tr>
                                <tr>
                                    <th>Impuestos</th>
                                    <th id="precio-impuestos-dhl"></th>
                                </tr>
                                <tr>
                                    <th>Cargo por logistica Interna</th>
                                    <th id="precio-logistica-interna-dhl"></th>
                                </tr>
                                <tr>
                                    <th class="text-danger">Precio Total</th>
                                    <th id="precio-total-dhl"></th>
                                </tr>
                            </tbody>

                            <tbody id="UPS" style="display: none">
                                <tr>
                                    <th>Costo Envio ups</th>
                                    <th id="precio-envio-ups"></th>
                                </tr>
                               
                                <tr>
                                    <th>Cargo por logistica Interna</th>
                                    <th id="precio-logistica-interna-ups"></th>
                                </tr>
                                <tr>
                                    <th class="text-danger">Precio Total</th>
                                    <th id="precio-total-ups"></th>
                                </tr>
                            </tbody>
                            
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-7">
            <div class="card">
                <div class="card-header d-flex justify-content-around ">
                    <h4 class="font-weight-bolder">Suministros</h4>
                    <button class="btn btn-success" id="add_suministro"><i class="fas fa-plus-circle"></i></button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <th>Suministro</th>
                                <th>Cantidad</th>
                                <th>Unitario</th>
                                <th>Total</th>
                                <th>Acciones</th>
                               
                            </thead>
                            <tbody>
    
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
