@php
    $precios = session()->get('precios') ;
@endphp
<div class="col-md-12">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <h4  class="font-weight-bolder">Realizar Pago</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="col-form-label  text-primary">Concepto de Pago </label>
                                <div class="input-group input-group-merge">
                                    
                                    {{ Form::select('metodo_pago',[
                                        'Efectivo' => 'Efectivo',
                                        'Tarjeta de debito' => 'Tarjeta de debito',
                                        'Tarjeta de credito' => 'Tarjeta de credito',
                                        'Transferencia' => 'Transferencia',
                                    ], 
                                        session()->get('values')->metodo_pago ?? '',[
                                            'placeholder' => 'Elegir tipo de pago ',
                                            'readonly' => session()->has('values')
                                                ? (session()->get('edit') == 1 ? false : true )
                                                : false,
                                            'class' => 'metodo-pago form-control  col-md-10 pl-1'
                                    ])}}
                                </div>
                               
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="col-form-label  text-primary">Monto</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">MXN</span>
                                        </div>
                                        {!! Form::input('number', 'cantidad_pago', $precios->precio_total_sucursal?? null, [
                                            'readonly' => session()->has('edit') ? (session()->get('edit') == 0 ? true : false) : false,
                                            'min' => '0', 
                                            'step' => '0.01',
                                            'class' => 'form-control pl-1 cantidad-pago', 
                                            // 'pattern' => "[0-9]{3}-[0-9]{2}-[0-9]{3}"
                                        ]) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="col-form-label  text-primary">Referencia </label>
                                <div class="input-group input-group-merge">
                                    {!! Form::input('number', 'referencia_pago', session()->get('values')->referencia_pago ?? null, [
                                            'readonly' => session()->has('edit') ? (session()->get('edit') == 0 ? true : false) : false,
                                            'min' => '0', 
                                            'class' => 'form-control pl-1 referencia-pago', 
                                            
                                    ]) !!}
                                    
                                </div>
                               
                            </div>
                        </div>
                    </div>
                    <div class="row d-flex justify-content-sm-around mt-2">
                        <button class="btn btn-success" type="submit">
                            {{ session()->get('edit') ? 'otra' : 'Pagar' }}
                        </button>
                        <a href="{{ route('envios.index') }}">
                            <div class="btn btn-danger">
                                <i class="fas fa-ban mr-1"></i>
                                Cancelar
                            </div>
                        </a>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>