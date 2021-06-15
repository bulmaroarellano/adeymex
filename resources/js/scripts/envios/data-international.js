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
