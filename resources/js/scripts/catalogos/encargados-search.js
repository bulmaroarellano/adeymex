$('.encargados-search').select2({

    placeholder: '<i class="fas fa-user-alt"></i> Buscar encargado',
    tags: true, 
    escapeMarkup : function(markup) {
        return markup;
    },
    ajax: {
        url: '/aydemex/public/encargados-search',
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