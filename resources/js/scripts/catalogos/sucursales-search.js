
$(function () {

    const path = window.location.pathname.split('/');

    const url =( path.length > 2) 
        ? window.location.origin + '/' + path[1] + '/'+ path[2] 
        : window.location.origin;

    $('.sucursales-search').select2({

        placeholder: '<i class="fas fa-store"></i> Buscar sucursal',
        escapeMarkup : function(markup) {
            return markup;
        },
        ajax: {
            url: `${url}/sucursales-search`,
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
                return {
                    results: $.map(data, function (item) {
                        return {
                            text: item.nombre,
                            id: item.id
                        }
                    })
                };
            },
            cache: true
        }
    });
});