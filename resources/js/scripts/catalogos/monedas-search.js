$('.monedas-search').select2({

    placeholder: '<i class="fas fa-coins"></i> Buscar moneda',
    escapeMarkup : function(markup) {
        return markup;
    },
    ajax: {
        url: '/monedas-search',
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