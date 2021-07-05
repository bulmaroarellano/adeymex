$(function() {
    const path = window.location.pathname.split('/');

    const url =( path.length > 2) 
        ? window.location.origin + '/' + path[1] + '/'+ path[2] 
        : window.location.origin;

    $('.zips-search').select2({

        placeholder: '<i class="fas fa-address-card"></i> Buscar codigo Postal ',
        escapeMarkup : function(markup) {
            return markup;
        },
        ajax: {
            url: `${url}/zips-search`,
            dataType: 'json',
            delay: 250,
            data: function(params){
                const countryCode = document.querySelector('.country-code').value;
    
                const query  ={
                    search : params.term, 
                    countryCode :countryCode 
                }
                return query;
            },
            processResults: function (data) {
                
                return {
                    results: $.map(data, function (item) {
                        
                        return {
    
                            text: `${item.postal_code}  ${item.place_name} , ${item.admin_name2} ${item.admin_name1} - ${item.country_code}`,
                            id: item.id
                        }
                    })
                };
            },
            cache: true
        }
    });

});