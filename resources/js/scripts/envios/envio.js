$("input[type='radio'][name='paqueteria']").on("change", function(){
    
    if($(this).is(':checked')){
        
        const nombrePaqueteria = $(this).val();
        console.log(nombrePaqueteria);
        if (nombrePaqueteria === "fedex") {
            
            $(".paqueteria-selec").html(`${nombrePaqueteria}`);
            $("#envio-fedex").show();
            $("#envio-dhl").hide();
            $("#envio-ups").hide();
            
            $("#nombre-paqueteria").val(`${nombrePaqueteria}`);
            
        }

        if (nombrePaqueteria === "dhl") {
            
            $(".paqueteria-selec").html(`${nombrePaqueteria}`);
            $("#envio-dhl").show();
            $("#envio-fedex").hide();
            $("#envio-ups").hide();

            $("#nombre-paqueteria").val(`${nombrePaqueteria}`);

            console.log(`la paqueteria es: ${$("#nombre-paqueteria").val()}`);

        }
        if (nombrePaqueteria === "ups") {
            
            $(".paqueteria-selec").html(`${nombrePaqueteria}`);
            $("#envio-ups").show();
            $("#envio-fedex").hide();
            $("#envio-dhl").hide();

            $("#nombre-paqueteria").val(`${nombrePaqueteria}`);
            
        }
  
    }else{

        $(".paqueteria-selec").html("seleciona una paqueteria");
        $("#envio-fedex").hide();
        $("#envio-dhl").hide();
        $("#envio-ups").hide();

        $("#nombre-paqueteria").val = '';
  
    }
});
  
  
  