
<div class="row mt-2" id="paquetes">
    <div class="col-12">
      <div class="card">
       
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                  <thead>
                      <tr>
                          <th>Tipo Paquete</th>
                          <th>Largo</th>
                          <th>Ancho</th>
                          <th>Alto</th>
                          <th>Peso</th>
                          <th>Acciones</th>
                      </tr>
                  </thead>
                  
                  @if ( ! session()->has('type_paquete'))
                  <tbody>
      
                      <tr>
                          <td>
                              {{ Form::select('type_paquete[]',[
                                  '1' => 'Paquete',
                                  '2' => 'Documento',
                                  '3' => 'Fedex-pak'
                                   ], 
                                  '',[
                                      'placeholder' => 'Seleccionar',
                                      'readonly' => session()->has('values')
                                          ? (session()->get('edit') == 1 ? false : true )
                                          : false,
                                      'class' => 'type-paquete form-control'
                              ])}}
                          </td>
                          <td>
                              {!! Form::text(
                                  'largo[]', '',[
                                      'readonly' => session()->has('edit') 
                                      ? session()->get('edit') == 0 ? true : false
                                      : false,
                                      'class' => 'largo form-control'
                                  ]) 
                              !!}
                          </td>
                          <td>
                              {!! Form::text(
                                  'ancho[]', '',[
                                      'readonly' => session()->has('edit') 
                                      ? session()->get('edit') == 0 ? true : false
                                      : false,
                                      'class' => 'ancho form-control'
                                  ]) 
                              !!}
                          </td>
                          <td>
                              {!! Form::text(
                                  'alto[]', '',[
                                      'readonly' => session()->has('edit') 
                                      ? session()->get('edit') == 0 ? true : false
                                      : false,
                                      'class' => 'alto form-control'
                                  ]) 
                              !!}
                          </td>
                          <td>
                              {!! Form::text(
                                  'peso[]', '',[
                                      'readonly' => session()->has('edit') 
                                      ? session()->get('edit') == 0 ? true : false
                                      : false,
                                      'class' => 'peso form-control'
                                  ]) 
                              !!}
                          </td>
                          <td><button class="btn btn-success" id="add_pack"><i class="fas fa-plus-circle"></i></button></td>
                      </tr>
                  
                  </tbody>
                  @else 
                      @php
                          $largo = session()->get('largo');
                          $ancho = session()->get('ancho');
                          $alto = session()->get('alto');
                          $peso = session()->get('peso');
                          $tipoPaquete = session()->get('type_paquete'); 
                      @endphp
                      <tbody>
                          @foreach ( session()->get('type_paquete') as $key => $paquete)
                              <tr>
                                  <td>
                                      {{ Form::select('type_paquete[]',[
                                          '1' => 'Paquete',
                                          '2' => 'Documento',
                                          '3' => 'Fedex-pak'
                                           ], 
                                          $paquete,[
                                              'placeholder' => 'Seleccionar',
                                              'readonly' => session()->has('values')
                                                  ? (session()->get('edit') == 1 ? false : true )
                                                  : false,
                                              'class' => 'type-paquete form-control'
                                      ])}}
                                  </td>
                                  <td>
                                      {!! Form::text(
                                          'largo[]', $largo[$key],[
                                              'readonly' => session()->has('edit') 
                                              ? session()->get('edit') == 0 ? true : false
                                              : false,
                                              'class' => 'largo form-control'
                                          ]) 
                                      !!}
                                  </td>
                                  <td>
                                      {!! Form::text(
                                          'ancho[]', $ancho[$key],[
                                              'readonly' => session()->has('edit') 
                                              ? session()->get('edit') == 0 ? true : false
                                              : false,
                                              'class' => 'ancho form-control'
                                          ]) 
                                      !!}
                                  </td>
                                  <td>
                                      {!! Form::text(
                                          'alto[]', $alto[$key],[
                                              'readonly' => session()->has('edit') 
                                              ? session()->get('edit') == 0 ? true : false
                                              : false,
                                              'class' => 'alto form-control'
                                          ]) 
                                      !!}
                                  </td>
                                  <td>
                                      {!! Form::text(
                                          'peso[]', $peso[$key],[
                                              'readonly' => session()->has('edit') 
                                              ? session()->get('edit') == 0 ? true : false
                                              : false,
                                              'class' => 'peso form-control'
                                          ]) 
                                      !!}
                                  </td>
                                  @if ($key > 0 )
                                      <td><button class="btn btn-danger" id="remove"><i class="fas fa-times-circle"></i></button></td>
                                  @else
                                      <td><button class="btn btn-success" id="add_pack"><i class="fas fa-plus-circle"></i></button></td>
                                  @endif
                              </tr>
                          @endforeach
                      </tbody>
                  @endif
                  
      
                </table>
              </div>
        </div>
      </div>
    </div>
</div>


