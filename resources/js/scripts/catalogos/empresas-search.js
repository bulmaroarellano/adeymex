$(function() {
    const path = window.location.pathname.split('/');

    const url =( path.length > 2) 
        ? window.location.origin + '/' + path[1] + '/'+ path[2]
        : window.location.origin;
    

    $('.empresas-search').select2({

        placeholder: '<i class="far fa-building"></i> Buscar empresa',
        
        escapeMarkup : function(markup) {
            return markup;
        },
        ajax: {
            
            url: `${url}/empresas-search`,
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