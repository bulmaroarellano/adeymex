
@if (session()->has('countryCode') && ! ( session()->get('countryCode') == "MX" ))
{{-- INTERNACIONAL  --}}

    <div class="col-md-4 ">
        <div class="card">
            <div class="card-body ">
                <div class="card-header"><h4 class="font-weight-bolder">Seguro</h4></div>
                <div class="row justify-content-center">

                    <div class="form-group col">
                        <label class="col-form-label text-primary">Valor declarado</label>
                        <div class="input-group input-group-merge">
                            <div class="input-group-prepend">
                                <span class="input-group-text">USD</span>
                            </div>
                            <input type="number" class="form-control pl-1" name="valor_declarado" value="0" id="valor-declarado" readonly>    
                        </div>
                    </div>


                    <div class="form-group col">
                        <label class="col-form-label text-primary">Valor asegurado *</label>
                        <div class="input-group input-group-merge">
                            <div class="input-group-prepend">
                                <span class="input-group-text">USD</span>
                            </div>
                            <input type="number" class="form-control pl-1" name="valor_asegurado" value="0" id="valor-asegurado" >
                        </div>
                        
                    </div>

                </div>

                <div class="row d-flex justify-content-center">
                    <div class="col-md-7">
                        <div class="form-group col">
                            <label class="col-form-label text-primary">Costo del Seguro *</label>
                            <div class="input-group input-group-merge">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">MXN</span>
                                </div>
                                <input type="number" class="form-control pl-1" name="costo_seguro" value="0" readonly id="costo_seguro">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@else

    {{-- NACIONAL  --}}
    <div class="col-md-4 ">
        <div class="card">
            <div class="card-body ">
                <div class="card-header"><h4 class="font-weight-bolder">Seguro</h4></div>
                <div class="row justify-content-center">


                    <div class="form-group col">
                        <label class="col-form-label text-primary">Valor asegurado *</label>
                        <div class="input-group input-group-merge">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="moneda-valor-asegurado"></span>
                            </div>
                            <input type="number" class="form-control pl-1" name="valor_asegurado" value="0" id="valor-asegurado" >
                        </div>
                    </div>
           
                    <div class="form-group col">
                        <label class="col-form-label text-primary">Costo del Seguro *</label>
                        <div class="input-group input-group-merge">
                            <div class="input-group-prepend">
                                <span class="input-group-text">MXN</span>
                            </div>
                            <input type="number" class="form-control pl-1" name="costo_seguro" value="0" readonly id="costo_seguro">
                        </div>
                    </div>
                    

                </div>
            </div>
        </div>
    </div>

@endif