$("input[type='radio'][name='tipo_servicio']").on("change", function(){
    
  if($(this).is(':checked')){
      
    $("#datos-envio").show();

    const nombreServicio = $(this).val();
    console.log(`nombreServicio ${nombreServicio}`);
    
    const precioEnvioSelec = document.querySelector(`#${nombreServicio}-monto`).innerText;
    const costFuel = document.querySelector(`#${nombreServicio}-fuel`).value;
    const costTax = document.querySelector(`#${nombreServicio}-tax`).value;

    
    const id_cp_destinatario = document.querySelector('.sepomex-search').value;
    const id_sucursal = document.querySelector('.sucursales-search').value;
    //+ Valores obtenidos de cotizacion_envio_form.blade
    const sucursalId  = document.querySelector('.sucursales-search').value;
    const typePaquete  = document.querySelector('.type-paquete').value;
    const largoPaquete = document.querySelector('.largo').value;
    const anchoPaquete = document.querySelector('.ancho').value;
    const altoPaquete  = document.querySelector('.alto').value;
    const pesoPaquete  = document.querySelector('.peso').value;
    const cargoLogistica  = document.querySelector('.cargo-logistica').value;
    const nombrePaqueteria  = document.querySelector('.nombre-paqueteria').value;

    $.ajax({
      type: 'get', 
      url : '/envios-search-cp', 
      data : {
        'id_sucursal': id_sucursal,
        'id_cp_destinatario' : id_cp_destinatario, 
      },
      success: (data) => {
        console.log(data);
        //+ Valores agregados a los desgloce de costos 

        document.querySelector('#precio-envio-fedex').innerText  = `${precioEnvioSelec}`;
        document.querySelector('#precio-logistica-interna').innerText  = `${cargoLogistica}`;
        document.querySelector('#precio-cargo-combustible').innerText  = `${costFuel}`;
        document.querySelector('#precio-impuestos').innerText  = `${costTax}`;

        const suma = parseFloat(precioEnvioSelec) + parseFloat(cargoLogistica) + parseFloat(costFuel) + parseFloat(costTax);
        document.querySelector('#precio-total').innerText  = `${suma.toFixed(2)}`;
        
        
        //+ Valores agregados hacia variables_envio.blade
        document.querySelector('#sucursal-id-envio').value  = `${sucursalId}`;
        document.querySelector('#type-paquete-fedex').value  = `${typePaquete}`;
        document.querySelector('#largo-paquete-fedex').value = `${largoPaquete}`;
        document.querySelector('#ancho-paquete-fedex').value = `${anchoPaquete}`;
        document.querySelector('#alto-paquete-fedex').value  = `${altoPaquete}`;
        document.querySelector('#peso-paquete-fedex').value  = `${pesoPaquete}`;
        document.querySelector('#cargo-logistica').value  = `${cargoLogistica}`;
        document.querySelector('#nombre-paqueteria').value  = `${nombrePaqueteria}`;

        document.querySelector('#costo-sucursal-envio').value  = `${precioEnvioSelec}`;
        document.querySelector('#cargos-envio').value  = `${costFuel}`;
        document.querySelector('#impuestos-envio').value  = `${costTax}`;
        document.querySelector('#precio-total-sucursal').value  = `${suma.toFixed(2)}`;

        document.querySelector('#id-cp-destinatario').value  = `${data.id_cp_destinatario}`;



        //+ Valores agregados al datos_envio_form.blade
        document.querySelector('.remitente-codigo-postal ').value    = `${data.cp_remitente}`;
        document.querySelector('.destinatario-codigo-postal ').value = `${data.cp_destinatario}`;



      }


    });


    }else{
      
      $("#datos-envio").hide();

    }
});


$("input[type='radio'][name='global_product_code']").on("change", function(){
    
  if($(this).is(':checked')){
      
    $("#datos-envio").show();

    const globalProductCode = $(this).val();
    const localProductCode = document.getElementById(`${globalProductCode}-local`).value; 
    const precioEnvioSelec = document.getElementById(`${globalProductCode}-monto`).innerText;
    const impuestos = document.getElementById(`${globalProductCode}-tax`).value;
    
    const id_sucursal = document.querySelector('.sucursales-search').value;
    const id_cp_destinatario = document.querySelector('.sepomex-search').value;
    const cargoLogistica  = document.querySelector('.cargo-logistica').value;
    const nombrePaqueteria  = document.querySelector('.nombre-paqueteria').value;

    //+ DIMENSIONES DEL PAQUETE 
    const largoPaquete = document.querySelector('.largo').value;
    const anchoPaquete = document.querySelector('.ancho').value;
    const altoPaquete  = document.querySelector('.alto').value;
    const pesoPaquete  = document.querySelector('.peso').value;
    
    $.ajax({
      type: 'get', 
      url : '/envios-search-cp', 
      data : {
        'id_sucursal': id_sucursal,
        'id_cp_destinatario' : id_cp_destinatario, 
      },
      success: (data) => {
      
        document.querySelector('#precio-envio-dhl').innerText  = `${precioEnvioSelec}`;
        document.querySelector('#precio-impuestos').innerText  = `${impuestos}`;
        document.querySelector('#precio-logistica-interna').innerText  = `${cargoLogistica}`;
        const suma = parseFloat(precioEnvioSelec) + parseFloat(cargoLogistica) +  parseFloat(impuestos);
        document.querySelector('#precio-total').innerText  = `${suma.toFixed(2)}`;

        //+ VARIABLES  GENERALES 
        document.querySelector('#sucursal-id-envio').value  = `${id_sucursal}`;
        document.querySelector('#local-product-code').value  = `${localProductCode}`;
        document.querySelector('#nombre-paqueteria').value  = `${nombrePaqueteria}`;

        //+ VARIABLES DIMENSIONES PAQUETE 
        document.querySelector('#largo-paquete-dhl').value = `${largoPaquete}`;
        document.querySelector('#ancho-paquete-dhl').value = `${anchoPaquete}`;
        document.querySelector('#alto-paquete-dhl').value  = `${altoPaquete}`;
        document.querySelector('#peso-paquete-dhl').value  = `${pesoPaquete}`;

        //+ VARIABLES COSTOS E IMPUESTOS 
        document.querySelector('#costo-sucursal-envio').value  = `${precioEnvioSelec}`;
        document.querySelector('#impuestos-envio').value  = `${impuestos}`;
        document.querySelector('#cargo-logistica').value  = `${cargoLogistica}`;
        document.querySelector('#precio-total-sucursal').value  = `${suma.toFixed(2)}`;
        document.querySelector('#id-cp-destinatario').value  = `${data.id_cp_destinatario}`;

        //+ Valores agregados al datos_envio_form.blade
        document.querySelector('.remitente-codigo-postal ').value    = `${data.cp_remitente}`;
        document.querySelector('.destinatario-codigo-postal ').value = `${data.cp_destinatario}`;

      }
    });


  }else{
    
    $("#datos-envio").hide();

  }

});

$("input[type='radio'][name='service_code']").on("change", function(){
    
  if($(this).is(':checked')){
      
    $("#datos-envio").show();

    const serviceCode = $(this).val();
   
    // const localProductCode = document.getElementById(`${serviceCode}-local`).value; 
    const precioEnvioSelec = document.getElementById(`${serviceCode}-monto`).innerText;
    // const impuestos = document.getElementById(`${serviceCode}-tax`).value;
    
    const id_sucursal = document.querySelector('.sucursales-search').value;
    const id_cp_destinatario = document.querySelector('.sepomex-search').value;
    const cargoLogistica  = document.querySelector('.cargo-logistica').value;
    const nombrePaqueteria  = document.querySelector('.nombre-paqueteria').value;

    //+ DIMENSIONES DEL PAQUETE 
    const largoPaquete = document.querySelector('.largo').value;
    const anchoPaquete = document.querySelector('.ancho').value;
    const altoPaquete  = document.querySelector('.alto').value;
    const pesoPaquete  = document.querySelector('.peso').value;
    
    $.ajax({
      type: 'get', 
      url : '/envios-search-cp', 
      data : {
        'id_sucursal': id_sucursal,
        'id_cp_destinatario' : id_cp_destinatario, 
      },
      success: (data) => {
      
        document.querySelector('#precio-envio-ups').innerText  = `${precioEnvioSelec}`;
        // document.querySelector('#precio-impuestos').innerText  = `${impuestos}`;
        document.querySelector('#precio-logistica-interna').innerText  = `${cargoLogistica}`;
        const suma = parseFloat(precioEnvioSelec) + parseFloat(cargoLogistica) ;
        document.querySelector('#precio-total').innerText  = `${suma.toFixed(2)}`;

        //+ VARIABLES  GENERALES 
        document.querySelector('#sucursal-id-envio').value  = `${id_sucursal}`;
        // document.querySelector('#local-product-code').value  = `${localProductCode}`;
        document.querySelector('#nombre-paqueteria').value  = `${nombrePaqueteria}`;

        //+ VARIABLES DIMENSIONES PAQUETE 
        document.querySelector('#largo-paquete-ups').value = `${largoPaquete}`;
        document.querySelector('#ancho-paquete-ups').value = `${anchoPaquete}`;
        document.querySelector('#alto-paquete-ups').value  = `${altoPaquete}`;
        document.querySelector('#peso-paquete-ups').value  = `${pesoPaquete}`;

        //+ VARIABLES COSTOS E IMPUESTOS 
        document.querySelector('#costo-envio-sucursal').value  = `${precioEnvioSelec}`;
        // document.querySelector('#impuestos-envio').value  = `${impuestos}`;
        document.querySelector('#cargo-logistica').value  = `${cargoLogistica}`;
        document.querySelector('#precio-total-sucursal').value  = `${suma.toFixed(2)}`;
        document.querySelector('#id-cp-destinatario').value  = `${data.id_cp_destinatario}`;

        //+ Valores agregados al datos_envio_form.blade
        document.querySelector('.remitente-codigo-postal ').value    = `${data.cp_remitente}`;
        document.querySelector('.destinatario-codigo-postal ').value = `${data.cp_destinatario}`;

      }
    });


  }else{
    
    $("#datos-envio").hide();

  }

});


