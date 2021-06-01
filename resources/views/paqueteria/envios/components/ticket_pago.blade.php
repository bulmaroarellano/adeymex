<section class="ticket">

    <div class="ticket__container">

        <div class="ticket__img">
          <img class="card-img-top" src="{{public_path('images/logo/adeymex-login.png')}}" alt="CardImage" width="100px" height="100px">
            {{-- <img class="card-img-top" src="{{ asset('images/adeymex-login.png') }}" alt="CardImage" width="100px"
                height="100px"> --}}
        </div>

        <div class="ticket__title">
            <h4>Grupo G.M Teotenango S.A. de C.V</h4>
        </div>

        <div class="ticket__direccion">
            <p>Benito Juárez #15 Col. Centro, Tenango del Valle, Mexico, C.P. 52300</p>
        </div>

        <div class="ticket__sucursal">
            <p>Sucursal: <span>SUCURSAL TOLUCA</span></p>
            <p>Direccion: 193 Lorem ipsum dolor sit amet consectetur, adipisicing elit. Cupiditate,
                consequatur!
            </p>
            <p class="text-center">Regimen General de Ley de Personas</p>
            <p>Cliente: <span>Cliente prueba</span></p>
        </div>

        <div class="ticket__precios">
            <table class="table">
                <thead  class="table-header">
                    <tr>
                        <th>Concepto</th>
                        <th>Precio</th>
                    </tr>
                </thead>
                <tbody class="table-cuerpo">
                    <tr>
                        <td>Costo Envio</td>
                        <td>{{$costo_sucursal}}</td>
                    </tr>
                    <tr>
                        <td>Cargos</td>
                        <td>{{$cargo_envio}}</td>
                    </tr>
                    <tr>
                        <td>Impuestos</td>
                        <td>{{$impuesto}}</td>
                    </tr>
                    <tr>
                        <td>Cargos logistica interna</td>
                        <td>{{$cargo_logistica}}</td>
                    </tr>
                    <tr>
                        <td class="text-rojo">Total a pagar</td>
                        <td>{{$total_precio}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <p class="text-center">Este comprobante no es valido para efectos fiscales </p>
    </div>

</section>