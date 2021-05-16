$(function(){

    $(document).on('change', '.sucursales-search', function(){ 

        const sucursalId = $(this).val();
        const div = $(this).parent();

        const sucursal = " ";
        

        $.ajax({
            type: 'get', 
            url: '/sucursales-find' ,
            data: {'id': sucursalId}, 
            success : (data) => {
                // console.log(data.codigo_postal + ' : ' + data['domicilio1'] );

                // document.getElementsByClassName(destino-envio)
                // div.find('destino-envio').val(data.domicilio1);

                // document.getElementsByClassName('destino-envio').value = data.domicilio1;
                document.querySelector('.origen-envio').value = data.domicilio1;
            }
        });

    })


});