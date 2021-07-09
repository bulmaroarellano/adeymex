
jQuery.datetimepicker.setLocale('es');

jQuery('#datetimepicker-recoleccion').datetimepicker({
    
    timepicker: true,
    format: 'd.m.Y H:i',
    mask:true,

    onSelectDate:function(ct,$i){
        
        const fecha = new Date(ct.toString().split('GMT')[0]+' UTC').toISOString().split('.')[0];
        // document.querySelector('#datetimepicker-recoleccion-fecha').value = fecha;
        document.querySelector('#datetimepicker-recoleccion-fecha').value = ct;
        
    },
    onSelectTime: function (ct,$i) {
      
        const fecha = new Date(ct.toString().split('GMT')[0]+' UTC').toISOString().split('.')[0];
        document.querySelector('#datetimepicker-recoleccion-fecha').value = fecha;
        
    }
   
});
jQuery('#datetimepicker-oficina').datetimepicker({
    
    timepicker: true,
    datepicker:false,
    format: 'H:i',
    mask:true,
});

jQuery('#datetimepicker-recepcion').datetimepicker({
    
    timepicker: true,
    format: 'd.m.Y H:i',
    mask:true,

    onSelectDate:function(ct,$i){
        
        const fecha = new Date(ct.toString().split('GMT')[0]+' UTC').toISOString().split('.')[0];
        // document.querySelector('#datetimepicker-recepcion-fecha').value = fecha;
        document.querySelector('#datetimepicker-recepcion-fecha').value = ct;
        
    },
    onSelectTime: function (ct,$i) {
      
        const fecha = new Date(ct.toString().split('GMT')[0]+' UTC').toISOString().split('.')[0];
        document.querySelector('#datetimepicker-recepcion-fecha').value = fecha;
        
    }
   
});
jQuery('#datetimepicker-oficina').datetimepicker({
    
    timepicker: true,
    datepicker:false,
    format: 'H:i',
    mask:true,
});