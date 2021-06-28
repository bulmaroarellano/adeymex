<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Invoice</title>
    <style>
        .page-break {
            page-break-after: always;
        }
        
        .text-right {
            text-align: right;
        }
        .text-center {
            text-align: center;
        }
        .margin-5y {
            margin: 5px 0 5px 0;
        }

        .w-full {
            width: 100%;
        }

        .small-width {
            width: 15%;
        }
        .flex{
            width: 50%;
            /* margin: auto; */
            margin-left: auto;
            text-align: right;
            /*demo*/
            
        }
    </style>
</head>
<body class="bg-grey">

  <div class="container container-smaller">

    <div class="row">
      <div class="col-lg-10 col-lg-offset-1">
          <div class="invoice">
              
            <div class="row">
              
                <div class="col-sm-6">
                <address>
                  <strong>Grupo G.M. Teotenango S.A. de C.V.</strong>
                  <br>
                  Benito Juárez #15 Col. Centro, Tenango del Valle
                  <br>
                  México, C.P. 52300.
                  <br>
                </address>
                <div class="text-right">
                    {{-- <img src="{{public_path('images/logo/adeymex-bw.png')}}" alt="" width="50px" height="50px"/> --}}
                    Image
                </div>
              </div>

            </div>

            <div class="row">

              <div class="col-sm-7">
                <address>
                  <strong>SUCURSAL TOLUCA</strong><br>
                  <span>CALLE 193 SN 50000 - Col. Centro - Toluca de Lerdo</span><br>
                </address>
              </div>

              <div class="col-sm-5 margin-5y">
                <div class="w-full text-center margin-5y">
                    <strong>Régimen General de Ley de Personas</strong><br>
                </div>
                <span>Cliente: <span>CLIENTE PRUEBA SUCURSAL TOLUCA</span></span><br>

                <div style="margin-bottom: 0px">&nbsp;</div>
              </div>

            </div>

            <div class="flex" >
              <table class="table invoice-table ">
                <thead style="background: #F5F5F5;">
                  <tr>
                    <th>Descripcion</th>
                    <th class="text-right">Precio</th>
                  </tr>
                </thead>
                <tbody>
                    {{-- FOr each  --}}
                  <tr>
                    <td>
                        <strong>Metodo de Pago</strong>
                    </td>
                    
                    <td class="text-right">{{$pago->metodo_pago}}</td>
                  </tr>

                  <tr>
                    <td>
                        <strong>Costo Envio</strong>
                    </td>
                    
                    <td class="text-right">
                      {{(float)$pago->costo_sucursal_envio + (float)$pago->cargo_logistica_interna + (float)$pago->impuestos_envio + (float)$pago->cargos_envio}}
                    </td>
                  </tr>
                  <tr>
                    <td>
                        <strong>Suministros</strong>
                    </td>
                    
                    <td class="text-right">{{$pago->suministros_precio_total}}</td>
                  </tr>
                  <tr>
                    <td>
                        <strong>Seguro</strong>
                    </td>
                    
                    <td class="text-right">{{$seguro}}</td>
                  </tr>

                  <tr>
                    <td>
                        <strong>Total</strong>
                    </td>
                    
                    <td class="text-right">{{$pago->precio_total_sucursal }}</td>
                  </tr>

                  </tbody>
                </table>
              </div><!-- /table-responsive -->
              <hr>

              <div class="row">
                <div class="col-lg-8">
                  <div class="invbody-terms">

                    <strong>Terminos y condiciones</strong>
                    <br>
                    <br>
                    <span>
                      Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium cumque neque velit tenetur pariatur perspiciatis dignissimos corporis laborum doloribus, inventore.
                    </span>
                  </div>
                </div>
              </div>

            </div>
        </div>
      </div>
    </div>

  </body>
</html>
