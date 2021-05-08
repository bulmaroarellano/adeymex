$('.encargados-search').select2({

    placeholder: '<i class="fas fa-user-alt"></i> Buscar encargado',
    escapeMarkup : function(markup) {
        return markup;
    },
    ajax: {
        url: '/encargados-search',
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
        cache: true,
    
    }
});