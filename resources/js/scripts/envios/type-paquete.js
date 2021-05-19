$(function () {

    $(document).on('change', '.type-paquete', function () {

        const tipoPaquete = $(this).val();
        console.log(tipoPaquete);
        if (tipoPaquete == "2") {
            document.querySelector('.largo').value = "30";
            document.querySelector('.largo').readOnly = true;
            
            document.querySelector('.ancho').value = "30";
            document.querySelector('.ancho').readOnly = true;
            
            document.querySelector('.alto').value = "5";
            document.querySelector('.alto').readOnly = true;
            
            document.querySelector('.peso').value = "0.5";
            document.querySelector('.peso').readOnly = true;
        
        } else {
            document.querySelector('.largo').value = "";
            document.querySelector('.largo').readOnly = false;

            document.querySelector('.ancho').value = "";
            document.querySelector('.ancho').readOnly = false;
            
            document.querySelector('.alto').value = "";
            document.querySelector('.alto').readOnly = false;

            document.querySelector('.peso').value = "";
            document.querySelector('.peso').readOnly = false;
        }
    })


});