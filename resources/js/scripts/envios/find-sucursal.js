$(function(){

    const path = window.location.pathname.split('/');

    const url =( path.length > 2) 
        ? window.location.origin + '/' + path[1] + '/'+ path[2] 
        : window.location.origin;

    $(document).on('change', '.sucursales-search', function(){ 

        const sucursalId = $(this).val();    
        $.ajax({
            type: 'get', 
            url: `${url}/sucursales-find`,
            data: {'id': sucursalId}, 
            success : (data) => { 
                document.querySelector('.origen-envio').value = ` ${data.codigo_postal} - ${data.domicilio1}`;
            }
        });

    })


});