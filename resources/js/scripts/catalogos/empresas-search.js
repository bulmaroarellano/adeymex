$('.empresas-search').select2({

    placeholder: '<i class="far fa-building"></i> Buscar empresa',
    escapeMarkup : function(markup) {
        return markup;
    },
    ajax: {
        url: '/aydemex/public/empresas-search',
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