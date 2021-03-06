$(function() {

    const path = window.location.pathname.split('/');

    const url =( path.length > 2) 
        ? window.location.origin + '/' + path[1] + '/'+ path[2] 
        : window.location.origin;

    $('.remitentes-search').select2({

        placeholder: '<i class="fas fa-address-card"></i> Buscar Remitente',
        tags: true, 
        escapeMarkup : function(markup) {
            return markup;
        },
        ajax: {
            url: `${url}/remitentes-search`,
            dataType: 'json',
            delay: 250,
            processResults: function (data) { 
                return {
                    results: $.map(data, function (item) {
                        return {
                            text: `${item.nombre}`,
                            id: item.id
                        }
                    })
                };
            },
            cache: true
        }
    });
        

});

$(function(){

    $(document).on('change', '.remitentes-search', function(){ 

        const path = window.location.pathname.split('/');

        const url =( path.length > 2) 
            ? window.location.origin + '/' + path[1] + '/'+ path[2] 
            : window.location.origin;

        const sucursalId = $(this).val();  

        $.ajax({
            type: 'get', 
            url: `${url}/remitentes-find` ,
            data: {'id': sucursalId}, 
            success : (data) => {
                // document.querySelector('.origen-envio').value = ` ${data.codigo_postal} - ${data.domicilio1}`;
                document.querySelector('.remitente-nombre-completo').value =
                    `${data.nombre} ${data.apellido_paterno} ${data.apellido_materno}`;
                
                document.querySelector('.remitente-empresa').value = `${data.nombre_empresa.nombre}`;
             
                document.querySelector('.remitente-pais').value = `${data.nombre_pais.nombre}`;
                document.querySelector('.remitente-domicilio1').value = `${data.domicilio1}`;
                document.querySelector('.remitente-domicilio2').value = `${data.domicilio2}`;
                document.querySelector('.remitente-domicilio3').value = `${data.domicilio3}`;
                document.querySelector('.remitente-telefono').value = `${data.telefono}`;
                document.querySelector('.remitente-email').value = `${data.email}`;
                

            }
        });

    })


});