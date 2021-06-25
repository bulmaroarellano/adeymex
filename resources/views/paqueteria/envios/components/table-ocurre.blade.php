@php
    $ocurres = session()->get('ocurres');
    $ocurre = session()->get('ocurre');
@endphp


<div class="card">
  <div class="card-body">
    <div class="table-responsive">
      <table class="table">
        <thead>
          <tr>
              <th>Distancia</th>
              <th>Servicio</th>
              <th>Descripcion</th>
              <th>Direccion</th>
              <th>Agregar</th>
          </tr>
        </thead>
        <tbody>
  
          
          @if ($ocurre)
            <tr>
              @foreach ($ocurres  as $key => $value)
                  @if ($key != 'id')
                    <td>{{$value}}</td>
                  @endif
              @endforeach
              <td><input class="" type="radio" name="ocurre" value='{{$ocurres['dir']}}' checked/></td>
            </tr>
              
          @else
            @foreach ($ocurres as $key => $ocurre)
              
              <tr>
                  <td>{{$ocurre->dis?? $ocurre}} </td>
                  <td>{{$ocurre->ser?? $ocurre}} </td>
                  <td>{{$ocurre->des?? $ocurre}} </td>
                  <td>{{$ocurre->dir?? $ocurre}} </td>
                  <td><input class="" type="radio" name="ocurre" value='{{json_encode($ocurre)}}'/></td>
              </tr>
            
            @endforeach
          @endif
          
  
        </tbody>
      </table>
  </div>
  </div>
</div>