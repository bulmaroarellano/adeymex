$(function () {

    const path = window.location.pathname.split('/');

    const url =( path.length > 2) 
        ? window.location.origin + '/' + path[1] + '/'+ path[2] 
        : window.location.origin;

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
                    url:`${url}/ocurre`,
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
