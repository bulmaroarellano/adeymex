$('.sucursales-search').select2({

    placeholder: '<i class="fas fa-store"></i> Buscar sucursal',
    escapeMarkup : function(markup) {
        return markup;
    },
    ajax: {
        url: '/sucursales-search',
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