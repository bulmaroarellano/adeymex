$('.paises-search').select2({

    placeholder: '<i class="fas fa-globe-americas"></i> Buscar Pais',
    escapeMarkup : function(markup) {
        return markup;
    },
    ajax: {
        url: '/paises-search',
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