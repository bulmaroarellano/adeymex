@php
    $ocurres = session()->get('ocurres');
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
  
          
          @foreach ($ocurres as $key => $ocurre)
              
              
              <tr>
                  <td>{{$ocurre->dis}} </td>
                  <td>{{$ocurre->ser}} </td>
                  <td>{{$ocurre->des}} </td>
                  <td>{{$ocurre->dir}} </td>
                  <td><input class="" type="radio" name="ocurre" value='{{$ocurre->dir}}'/></td>
              </tr>
              
          @endforeach
          
  
        </tbody>
      </table>
  </div>
  </div>
</div>