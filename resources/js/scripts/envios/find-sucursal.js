$(function(){

    $(document).on('change', '.sucursales-search', function(){ 

        const sucursalId = $(this).val();    
        $.ajax({
            type: 'get', 
            url: '/sucursales-find' ,
            data: {'id': sucursalId}, 
            success : (data) => {
                document.querySelector('.origen-envio').value = ` ${data.codigo_postal} - ${data.domicilio1}`;
            }
        });

    })


});