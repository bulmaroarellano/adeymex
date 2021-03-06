$(function () {

    $(document).on('change', 'select[name="paqueteria"]', function(){

        const paqueteria = $(this).val();

        console.log(`busqueda paqueteria :  ${paqueteria}`);
        const path = window.location.pathname.split('/');

        const url =( path.length > 2) 
            ? window.location.origin + '/' + path[1] + '/'+ path[2] 
            : window.location.origin;

        var table = $('.datatables-basic').DataTable({

            processing: true,
            serverSide: true,
            destroy: true,
            ajax: {
                'url': `${window.location.pathname}/paqueteria`, 
                'data' :{
                    'paqueteria': paqueteria
                }
            },
            columns: [
    
                { data: 'sucursal_id.0.nombre' },
                { data: 'paqueteria' },
                { data: 'master_guia' },
                { data: 'status_envio' },
                { data: 'status_recoleccion' },
                { data: 'remitente_id.0.nombre' },
                { data: 'destinatario_id.0.nombre' },
    
                {
                    data: 'action',
                    name: 'action',
                    orderable: true,
                    searchable: true
                }
            ],
            dom:
                '<"card-header border-bottom p-1"<"head-label"><"dt-action-buttons text-right"B>><"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
            displayLength: 7,
            lengthMenu: [7, 10, 25, 50, 75, 100],
            buttons: [
                {
                    extend: 'collection',
                    className: 'btn btn-outline-secondary dropdown-toggle mr-2',
                    text: feather.icons['share'].toSvg({ class: 'font-small-4 mr-50' }) + 'Export',
                    buttons: [
                        {
                            extend: 'print',
                            text: feather.icons['printer'].toSvg({ class: 'font-small-4 mr-50' }) + 'Print',
                            className: 'dropdown-item',
                            exportOptions: { columns: [0, 1, 2, 3, 4, 5, 6, 7] }
                        },
                        {
                            extend: 'csv',
                            text: feather.icons['file-text'].toSvg({ class: 'font-small-4 mr-50' }) + 'Csv',
                            className: 'dropdown-item',
                            exportOptions: { columns: [0, 1, 2, 3, 4, 5, 6, 7] }
                        },
                        {
                            extend: 'excel',
                            text: feather.icons['file'].toSvg({ class: 'font-small-4 mr-50' }) + 'Excel',
                            className: 'dropdown-item',
                            exportOptions: { columns: [0, 1, 2, 3, 4, 5, 6, 7] }
                        },
                        {
                            extend: 'pdf',
                            text: feather.icons['clipboard'].toSvg({ class: 'font-small-4 mr-50' }) + 'Pdf',
                            className: 'dropdown-item',
                            exportOptions: { columns: [0, 1, 2, 3, 4, 5, 6, 7] }
                        },
                        {
                            extend: 'copy',
                            text: feather.icons['copy'].toSvg({ class: 'font-small-4 mr-50' }) + 'Copy',
                            className: 'dropdown-item',
                            exportOptions: { columns: [0, 1, 2, 3, 4, 5, 6, 7] }
                        }
                    ],
                    init: function (api, node, config) {
                        $(node).removeClass('btn-secondary');
                        $(node).parent().removeClass('btn-group');
                        setTimeout(function () {
                            $(node).closest('.dt-buttons').removeClass('btn-group').addClass('d-inline-flex');
                        }, 50);
                    }
                },
               
            ],
            "language": {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
            }
        });

    });


});