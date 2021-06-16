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

    })


});
