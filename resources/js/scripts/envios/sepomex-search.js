$('.sepomex-search').select2({

    placeholder: '<i class="fas fa-address-card"></i> Buscar codigo Postal MX',
    escapeMarkup : function(markup) {
        return markup;
    },
    ajax: {
        url: '/sepomex-search',
        dataType: 'json',
        delay: 250,
        processResults: function (data) {
            return {
                results: $.map(data, function (item) {
                    return {

                        text: `${item.d_codigo}  ${item.d_asenta} - ${item.D_mnpio}, ${item.d_estado}`,
                        id: item.id
                    }
                })
            };
        },
        cache: true
    }
});