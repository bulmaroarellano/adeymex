$(function () {


    const countryCode = $(".country-code").val();


    if (countryCode !== "MX") {
        // INTERNACIONAL 

        $("#moneda-valor-asegurado").text('USD');

        $("#table-intl").on("change", "tbody tr td input[name='precio_unitario[]']", function () {

            const cantidades = $('input[name="cantidad[]"]').map(function () {
                return $(this).val();
            }).get();

            const precios = $('input[name="precio_unitario[]"]').map(function () {
                return $(this).val();
            }).get();

            const valuesMulti = cantidades.map((cantidad, i) => cantidad * precios[i]);

            console.log(valuesMulti);

            const valorDeclarado = valuesMulti.reduce((a, b) => a + b);

            $("#valor-declarado").val(valorDeclarado);

        });

        $("input[type='radio'][name='paqueteria_code']").on("change", function(){

            if($(this).is(':checked')){
                const paqueteriaCode = $(this).val();   
                const nombrePaqueteria = document.getElementById(`${paqueteriaCode}-paqueteria`).innerText;

                $("#valor-asegurado").on('change', function () {

                    const valorAsegurado = $(this).val();
                    const valorDeclarado = $("#valor-declarado").val();
                    
                    if (+valorAsegurado > valorDeclarado) {
                        
                        const message = $(this).closest('div').siblings('strong');
        
                        if ( message.length === 0) {
                            $(this).closest('div').after(`<strong class="text-danger">El valor tiene que ser menor o igual a ${valorDeclarado} </strong>`);
                        }
        
                    } else {
                            
                        $(this).closest('div').siblings('strong').remove();
                    }
        
        
                    if (valorAsegurado > 99 && !(valorAsegurado > valorDeclarado) && (nombrePaqueteria == "FEDEX")) {
        
                        const costoSeguro = `${ (+valorAsegurado.slice(0, 1) *30) }`;
                        
                        $("#costo_seguro").val(`${costoSeguro}`);
        
                    } 

                    if (valorAsegurado > 99 && !(valorAsegurado > valorDeclarado ) && (nombrePaqueteria == "DHL")) {
        
                        const costoSeguro = `${ (+valorAsegurado.slice(0, 1) *50) }`;
                        
                        $("#costo_seguro").val(`${costoSeguro}`);
        
                    } else {
                        $("#costo_seguro").val('0');
                    }
        
                });
            }
        });

        
        
    }else{
        //! SEGURO NACIONAL 1.5 CADA 100 PESOS 
        $("#moneda-valor-asegurado").text('MXN');


        $("#valor-asegurado").on('change', function () {

            const valorAsegurado = $(this).val();
            
            
            if ( +valorAsegurado > 3500) {

                const costoSeguro = 132.5 + ((+valorAsegurado - 3500) *0.015);
                
                $("#costo_seguro").val(`${costoSeguro.toFixed(2)}`);

            } else {
                $("#costo_seguro").val('0');
            }


        });
    }




});
