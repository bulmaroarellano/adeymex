$(function () {



    const countryCode = $(".country-code").val();

    console.log(`countryCOde -> ${countryCode}`);


    //* ValorAsegurado = Cantidad * precio Unitario 

    if (countryCode !== "MX") {


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


            if (valorAsegurado > 99 && !(valorAsegurado > valorDeclarado)) {

                const costoSeguro = `${ (+valorAsegurado.slice(0, 1) *30) }`;
                
                $("#costo_seguro").val(`${costoSeguro}`);

            } else {
                $("#costo_seguro").val('0');
            }

        });
        
    }

});
