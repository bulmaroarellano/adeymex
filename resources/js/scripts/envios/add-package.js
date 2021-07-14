$(function () {

    $('#add_btn').on('click', function(e) {
        e.preventDefault();
        const html =
            `
            <tr>
                <td><input class="form-control" type="text" name="desc_producto[]"  /></td>
                <td><input class="form-control" type="text" name="cantidad[]"       /></td>
                <td><input class="form-control" type="text" name="unidad_medida[]"  /></td>
                <td><input class="form-control" type="text" name="precio_unitario[]"/></td>
                <td><input class="form-control" type="text" name="peso_neto[]"      /></td>
                <td><input class="form-control" type="text" name="peso_bruto[]"     /></td>
                <td><button class="btn btn-danger" id="remove"><i class="fas fa-times-circle"></i></button></td>
            </tr>
        
        `;
        // $('tbody').append(html);
        $(this).closest('tbody').append(html);
    });

    $(document).on('click', '#remove', function () {
        console.log('Borrando')
        $(this).closest('tr').remove();

        const cantidades = $('input[name="cantidad[]"]').map( function(){
            return $(this).val();
        }).get(); 

        const precios = $('input[name="precio_unitario[]"]').map(function(){
            return $(this).val();
        }).get();

        const valuesMulti = cantidades.map((cantidad, i ) => cantidad * precios[i]);

        console.log(valuesMulti);

        const valorDeclarado = valuesMulti.reduce((a, b) => a+b);

        $("#valor-declarado").val(valorDeclarado);

    })


});

$(function () {

    $('#add_pack').on('click', function(e) {
        e.preventDefault();
        const html =
            `
            <tr>
                <td>
                    <select name="type_paquete[]" class="form-control type-paquete">
                        <option selected>Seleccionar</option>
                        <option value="1">Paquete</option>
                        <option value="2">Documento</option>
                        <option value="3">Fedex-pak</option>
                    </select>
                </td>

                <td><input class="form-control largo" type="text" name="largo[]"  /></td>
                <td><input class="form-control ancho" type="text" name="ancho[]"  /></td>
                <td><input class="form-control alto" type="text" name="alto[]"   /></td>
                <td><input class="form-control peso" type="text" name="peso[]"   /></td>
                <td><button class="btn btn-danger" id="remove"><i class="fas fa-times-circle"></i></button></td>
            </tr>
        
        `;

        $(this).closest('tbody').append(html);
   
        // $('.paquete').append(html);
     
    });

    $(document).on('click', '#remove', function () {
        console.log('Borrando')
        $(this).closest('tr').remove();

    });

});

$(function () {


    $('#add_suministro').on('click', function(e) {
        e.preventDefault();
        const html =
            `
            <tr>
                <td>
                    <select name="suministro_id[]" class="suministro-search form-control"></select>
                </td>
                <td><input class="form-control" type="text" name="suministro_cantidad[]"/></td>
                <td><input class="form-control" type="text" name="suministro_precio_unitario[]"  /></td>
                <td><input class="form-control" type="text" name="suministro_precio_total[]"  /></td>
                <td><button class="btn btn-danger" id="remove"><i class="fas fa-times-circle"></i></button></td>
            </tr>
        
        `;
        const tbody = $(this).siblings('div').children('div').children('table').children('tbody');
        tbody.append(html);

        $('.suministro-search').select2({
    
            placeholder: 'Suministro',
            ajax: {
                url: '/suministros-search',
                dataType: 'json',
                delay: 250,
                processResults: function (data) {
                    
                    return {
                        results: $.map(data, function (item) {
                            
                            return {
                                text: `${item.nombre}`,
                                precioUnitario: `${item.precio_publico}`,
                                id: item.id
                            }
                        })
                    };
                },
                cache: true
            }, 
        });


     
    });

    

    $(document).on('click', '#remove', function () {
        console.log('Borrando')
        $(this).closest('tr').remove();

    });
    
    $(document).on('change', 'select[name="suministro_id[]"]', function () {

        const inputCantidad       = $(this).closest('td').siblings('td')[0].children[0].value;
        const inputPrecioUnitario = $(this).closest('td').siblings('td')[1].children[0];
        const inputTotal          = $(this).closest('td').siblings('td')[2].children[0];
        const suministro = $('.suministro-search').select2('data'); 
        
        inputPrecioUnitario.value = suministro[0].precioUnitario;

        if (inputCantidad) {
            inputTotal.value =  `${inputCantidad * inputPrecioUnitario.value}`;
        }
                
    });

    $(document).on('change', 'input[name="suministro_cantidad[]"]', function () {
        const suministro = $('.suministro-search').select2('data'); 
        
        const cantidad = $(this).val();

        const inputTotal = $(this).closest('td').siblings('td')[2].children[0]
        inputTotal.value = `${cantidad * suministro[0].precioUnitario}`

        const paqueteriaCode = $("input[type='radio'][name='paqueteria_code']:checked").val();

        const nombrePaqueteria = document.getElementById(`${paqueteriaCode}-paqueteria`).innerText;
        console.log(nombrePaqueteria)
    });

   

});




$(function () {

    $('#add_recepcion').on('click', function(e) {
        e.preventDefault();
        const html =
            `
            <tr>

                <td><input class="form-control " type="text" name="cantidad_paquetes[]"  /></td>
                <td><input class="form-control " type="text" name="numero_guia[]" maxlength="18" /></td>
                <td><input class="form-control " type="text" name="costo[]"   /></td>
                <td><input class="form-control " type="text" name="observaciones[]"   /></td>
                <td><button class="btn btn-danger" id="remove"><i class="fas fa-times-circle"></i></button></td>
            </tr>
        
        `;

        const tbody = $(this).siblings('div').children('div').children('table').children('tbody');
        tbody.append(html);

     
    });

    $(document).on('click', '#remove', function () {
        console.log('Borrando')
        $(this).closest('tr').remove();

    });

});
        
        


