$(function () {
    let count = 1;

    console.log("cargadno")

    const countDynamic = (number) => {
        console.log('hola que tal')
        const remove = `
            <td>
                <button type="submit" name="remove" id="remove" class="btn btn-danger">Remove</button>

            </td>
        </tr>
        `;
        const add = `
            <td>
                <button type="submit" name="add" id="add" class="btn btn-sucess">Add</button>
            </td> 
        </tr>
        `;
        const html = `
            <tr>
                <td><input type="text" name="desc_producto[]"/></td>
                <td><input type="text" name="cantidad[]"/></td>
                <td><input type="text" name="unidad_medida[]"/></td>
                <td><input type="text" name="precio_unitario[]"/></td>
                <td><input type="text" name="peso_neto[]"/></td>
                <td><input type="text" name="peso_bruto[]"/></td>

                ${number > 1 ? remove: add}
        `;
        $('#data-intl').append(html);

    }
    countDynamic(count);

    $('#add').on("click", () => {
        count++;
        countDynamic(count);
    });

    $('#remove').on("click", () => {
        count--;
        countDynamic(count);
    });

    $('#data_intl').on("submit", (event) => {
        event.preventDefault();
        $.ajax({
            url: '/intl-data', 
            method: 'post', 
            data: $(this).serialize(), 
            dataType: 'json', 
            beforeSend: function(){
                $('#save').attr('disabled', 'disabled');
            }, 
            success: function(data){

                countDynamic(1);
                
                $('#result').html(
                    `
                    <div class="alert alert-success"> ${data.success}</div>
                    `
                );

                $('#save').attr('disabled', false);
            }
        });
    }); 
    
});