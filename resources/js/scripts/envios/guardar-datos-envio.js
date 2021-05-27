$("input[type='radio'][name='tipo_servicio']").on("change", function(){
    
  if($(this).is(':checked')){
      
    $("#datos-envio").show();

    const nombreServicio = $(this).val();
    
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


