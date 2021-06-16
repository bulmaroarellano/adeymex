$(function () {

    $(document).on('change', 'select[name="type_paquete[]"]', function () {

        const tipoPaquete = $(this).val();


        const tds = $(this).closest('td').siblings('td');
        if (tipoPaquete == "2") {
            tds[0].children[0].value = '30'; // largo
            tds[1].children[0].value = '30'; // ancho
            tds[2].children[0].value = '5'; // alto
            tds[3].children[0].value = '0.5'; // peso

           
        
        } else {
            
            tds[0].children[0].value = ''; // largo
            tds[1].children[0].value = ''; // ancho
            tds[2].children[0].value = ''; // alto
            tds[3].children[0].value = ''; // peso
        }
    });


});