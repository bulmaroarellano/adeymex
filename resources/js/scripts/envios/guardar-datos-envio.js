$("input[type='radio'][name='paqueteria_code']").on("change", function(){

  if($(this).is(':checked')){

    $("#datos-envio").show();
    const paqueteriaCode = $(this).val();    
    const nombrePaqueteria = document.getElementById(`${paqueteriaCode}-paqueteria`).innerText;

    if (nombrePaqueteria == "FEDEX") {
      
      $("#FEDEX").show();
      $("#DHL").hide();
      $("#UPS").hide();

    }
    
    if (nombrePaqueteria == "DHL") {
      
      $("#FEDEX").hide();
      $("#DHL").show();
      $("#UPS").hide();
      
    }
    
    if (nombrePaqueteria == "UPS") {
      $("#FEDEX").hide();
      $("#DHL").hide();
      $("#UPS").show();
    }
    //+ DATOS GENERALES 
    const id_sucursal = document.querySelector('.sucursales-search').value;
    const id_cp_destinatario = document.querySelector('.zips-search').value;
    const cargoLogistica = document.querySelector('.cargo-logistica').value;
    const countryCode   = document.querySelector('.country-code').value;
    const seguroEnvio   = document.querySelector('.seguro-envio').value;
    //+ DIMENSIONES DEL PAQUETE 
    const largoPaquete = document.querySelector('.largo').value;
    const anchoPaquete = document.querySelector('.ancho').value;
    const altoPaquete  = document.querySelector('.alto').value;
    const pesoPaquete  = document.querySelector('.peso').value;

    const precioEnvioSelec = document.getElementById(`${paqueteriaCode}-monto`).innerText;

    $.ajax({

      type: 'get', 
      url : '/search-zips', 
      data : {
        'id_sucursal': id_sucursal,
        'id_cp_destinatario' : id_cp_destinatario, 
      },
      success: (data) => {
        

        if (nombrePaqueteria == "FEDEX") {
          dataEnvioFedex(paqueteriaCode, precioEnvioSelec, cargoLogistica);
        }
        if (nombrePaqueteria == "DHL") {
          dataEnvioDhl(paqueteriaCode, precioEnvioSelec, cargoLogistica);
        }
        if (nombrePaqueteria == "UPS") {
          dataEnvioUps(paqueteriaCode, precioEnvioSelec, cargoLogistica );
        }
        //DATOS GENERALES 
        document.querySelector('#sucursal-id-envio').value  = `${id_sucursal}`;
        document.querySelector('#id-cp-destinatario').value  = `${data.id_cp_destinatario}`;
        document.querySelector('#nombre-paqueteria').value  = `${nombrePaqueteria}`;
        document.querySelector('#country-code').value  = `${countryCode}`;
        document.querySelector('#seguro-envio').value  = `${seguroEnvio}`;
        // PAQUETE 
        document.querySelector('#largo-paquete').value = `${largoPaquete}`;
        document.querySelector('#ancho-paquete').value = `${anchoPaquete}`;
        document.querySelector('#alto-paquete').value  = `${altoPaquete}`;
        document.querySelector('#peso-paquete').value  = `${pesoPaquete}`;
        //COSTOS E IMPUESTOS 
        document.querySelector('#costo-sucursal-envio').value  = `${precioEnvioSelec}`;
        document.querySelector('#cargo-logistica').value  = `${cargoLogistica}`;
        
        //+ Valores agregados al datos_envio_form.blade
        document.querySelector('.remitente-codigo-postal ').value    = `${data.cp_remitente}`;
        document.querySelector('.destinatario-codigo-postal ').value = `${data.cp_destinatario}`;

      
      }
    });

  }else{
    
    $("#datos-envio").hide();

  }
});

const dataEnvioFedex = (paqueteriaCode, precioEnvioSelec, cargoLogistica) => {
  
  
  const costFuel = document.querySelector(`#${paqueteriaCode}-fuel`).value;
  const costTax = document.querySelector(`#${paqueteriaCode}-tax`).value;
  const typePaquete  = document.querySelector('.type-paquete').value;

  document.querySelector('#precio-envio-fedex').innerText  = `${precioEnvioSelec}`;
  document.querySelector('#precio-logistica-interna').innerText  = `${cargoLogistica}`;
  document.querySelector('#precio-cargo-combustible').innerText  = `${costFuel}`;
  document.querySelector('#precio-impuestos').innerText  = `${costTax}`;

  const suma = parseFloat(precioEnvioSelec) + parseFloat(cargoLogistica) + parseFloat(costFuel) + parseFloat(costTax);
  document.querySelector('#precio-total').innerText  = `${suma.toFixed(2)}`;

  document.querySelector('#cargos-envio').value  = `${costFuel}`;
  document.querySelector('#impuestos-envio').value  = `${costTax}`;
  document.querySelector('#precio-total-sucursal').value  = `${suma.toFixed(2)}`;

  //+ VARIANTE CODIGO ENVIO
  document.querySelector('#type-paquete-fedex').value  = `${typePaquete}`;

}

const dataEnvioDhl = (paqueteriaCode, precioEnvioSelec, cargoLogistica) => {

  const localProductCode = document.getElementById(`${paqueteriaCode}-local`).value; 
  const impuestos = document.getElementById(`${paqueteriaCode}-tax`).value;

  document.querySelector('#precio-envio-dhl').innerText  = `${precioEnvioSelec}`;
  document.querySelector('#precio-impuestos-dhl').innerText  = `${impuestos}`;
  document.querySelector('#precio-logistica-interna-dhl').innerText  = `${cargoLogistica}`;
  const suma = parseFloat(precioEnvioSelec) + parseFloat(cargoLogistica) +  parseFloat(impuestos);
  document.querySelector('#precio-total-dhl').innerText  = `${suma.toFixed(2)}`;

  //+ VARIABLES COSTOS E IMPUESTOS 
  document.querySelector('#impuestos-envio').value  = `${impuestos}`;
  document.querySelector('#precio-total-sucursal').value  = `${suma.toFixed(2)}`;

  //+ VARIANTE CODIGO ENVIO
  document.querySelector('#local-product-code').value  = `${localProductCode}`;
  

}

const dataEnvioUps = ( paqueteriaCode, precioEnvioSelec, cargoLogistica ) => {

  document.querySelector('#precio-envio-ups').innerText  = `${precioEnvioSelec}`;
  // document.querySelector('#precio-impuestos').innerText  = `${impuestos}`;
  document.querySelector('#precio-logistica-interna-ups').innerText  = `${cargoLogistica}`;
  const suma = parseFloat(precioEnvioSelec) + parseFloat(cargoLogistica) ;
  document.querySelector('#precio-total-ups').innerText  = `${suma.toFixed(2)}`;

  //+ VARIABLES COSTOS E IMPUESTOS 
  document.querySelector('#precio-total-sucursal').value  = `${suma.toFixed(2)}`;

  //+ VARIANTE CODIGO ENVIO
  // document.querySelector('#local-product-code').value  = `${localProductCode}`;


}