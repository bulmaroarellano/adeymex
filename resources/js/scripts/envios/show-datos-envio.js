$("input[type='radio'][name='nombreEnvio']").on("change", function(){
    
  if($(this).is(':checked')){

      $("#datos-envio").show();
      const id_cp_destinatario = document.querySelector('.sepomex-search').value;
      const id_sucursal = document.querySelector('.sucursales-search').value;
      
      const typePaquete  = document.querySelector('.type-paquete').value;
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
         
          document.querySelector('.remitente-codigo-postal ').value    = `${data.cp_remitente}`;
          document.querySelector('.destinatario-codigo-postal ').value = `${data.cp_destinatario}`;

          document.querySelector('#type-paquete-fedex').value  = `${typePaquete}`;
          document.querySelector('#largo-paquete-fedex').value = `${largoPaquete}`;
          document.querySelector('#ancho-paquete-fedex').value = `${anchoPaquete}`;
          document.querySelector('#alto-paquete-fedex').value  = `${altoPaquete}`;
          document.querySelector('#peso-paquete-fedex').value  = `${pesoPaquete}`;



        }


      });


    }else{
      $("#datos-envio").hide();
    }
});


