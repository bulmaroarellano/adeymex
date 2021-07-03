$(function () {

    $('#add_ocurre').on('click', function(e) {
        e.preventDefault();

        const idZip = document.querySelector('.zips-search').value;
        console.log(`idZip --> ${idZip}`)

        if (idZip > 0) {
            

            $('.ocurre-search').select2({

                placeholder: '<i class="fas fa-address-card"></i> Fedex',
                escapeMarkup : function(markup) {
                    return markup;
                },
                ajax: {
                    url: '/aydemex/public/ocurre',
                    dataType: 'json',
                    delay: 250,
                    data: function(params){
                        const query  ={
                            search : params.term, 
                            idZip :idZip 
                        }
                        return query;
                    },
                    processResults: function (data) {
                        
                        console.log(data);

                        return {
                            results: $.map(data, function (item) {
                                
                                return {
            
                                    text: `${item.dis}  ${item.dir}`,
                                    id: item.id
                                }
                            })
                        };
                    },
                    cache: true
                }
            });


        }
        
    });

});
