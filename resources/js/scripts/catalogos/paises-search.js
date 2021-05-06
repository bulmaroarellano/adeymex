$('.paises-search').select2({

    placeholder: 'Buscar Pais',
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