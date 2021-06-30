<div class="col-md-12">


    <div class="row">
        <div class="col-md-4">
            {{-- DIRECCION --}}
            <div class="card">
                <div class="card-body">
                    
                </div>
            </div>
        </div>
        <div class="col-md-4">
            {{-- PAQUETES --}}

            <div class="card">
                <div class="card-body">

                </div>
            </div>

        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Largo</th>
                                    <th>Ancho</th>
                                    <th>Alto</th>
                                    <th>Peso</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{$masterPaquete->largo_paquete}}</td>
                                    <td>{{$masterPaquete->ancho_paquete}}</td>
                                    <td>{{$masterPaquete->alto_paquete}}</td>
                                    <td>{{$masterPaquete->peso_paquete}}</td>
                                </tr>

                                <tr>
                                    @foreach ($slavePaquetes as $paquete)
                                        <td>{{$paquete['largo_paquete']}}</td>
                                        <td>{{$paquete['ancho_paquete']}}</td>
                                        <td>{{$paquete['alto_paquete']}}</td>
                                        <td>{{$paquete['peso_paquete']}}</td>
                                    @endforeach
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            {{-- Suministros --}}
            {{-- PAGOS --}}
            <div class="card">
                <div class="card-body">
                    
                </div>
            </div>
        </div>
        <div class="col-md-6">
            {{-- DESCARGAS --}}
            <div class="card">
                <div class="card-body">
                    
                </div>
            </div>

        </div>
    </div>




</div>