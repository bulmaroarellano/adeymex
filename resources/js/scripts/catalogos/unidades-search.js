$(function() {

    const path = window.location.pathname.split('/');

    const url =( path.length > 2) 
        ? window.location.origin + '/' + path[1] + '/'+ path[2] 
        : window.location.origin;

    $('.unidades-search').select2({

        placeholder: '<i class="fas fa-balance-scale"></i> Buscar unidad de Medida',
        escapeMarkup : function(markup) {
            return markup;
        },
        ajax: {
            url: `${url}/unidades-search`,
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
                return {
                    results: $.map(data, function (item) {
                        return {
                            text: item.unidad_medida,
                            id: item.id
                        }
                    })
                };
            },
            cache: true
        }
    });
});