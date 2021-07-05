$(function() {

    const path = window.location.pathname.split('/');

    const url =( path.length > 2) 
        ? window.location.origin + '/' + path[1] + '/'+ path[2] 
        : window.location.origin;

    $('.destinatarios-search').select2({

        placeholder: '<i class="fas fa-address-card"></i> Buscar Remitente',
        tags: true, 
        escapeMarkup : function(markup) {
            return markup;
        },
        ajax: {
            url: `${url}/destinatarios-search`,
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

    const path = window.location.pathname.split('/');

    const url =( path.length > 2) 
        ? window.location.origin + '/' + path[1] + '/'+ path[2] 
        : window.location.origin;

    $(document).on('change', '.destinatarios-search', function(){ 

        const sucursalId = $(this).val();  

        $.ajax({
            type: 'get', 
            url: `${url}/destinatarios-find` ,
            data: {'id': sucursalId}, 
            success : (data) => {
                // document.querySelector('.origen-envio').value = ` ${data.codigo_postal} - ${data.domicilio1}`;
                document.querySelector('.destinatario-nombre-completo').value =
                    `${data.nombre} ${data.apellido_paterno} ${data.apellido_materno}`;
                
                document.querySelector('.destinatario-empresa').value = `${data.nombre_empresa.nombre}`;
                document.querySelector('.destinatario-pais').value = `${data.nombre_pais.nombre}`;

                const valueD1 = document.querySelector('.destinatario-domicilio1').value;

                if ( valueD1 == "") {
                    document.querySelector('.destinatario-domicilio1').value = `${data.domicilio1}`;
                }

                document.querySelector('.destinatario-domicilio2').value = `${data.domicilio2}`;
                document.querySelector('.destinatario-domicilio3').value = `${data.domicilio3}`;
                document.querySelector('.destinatario-telefono').value = `${data.telefono}`;
                document.querySelector('.destinatario-email').value = `${data.email}`;
                
        
            }
        });

    })


});