<script src="./js/jquery.min.js"></script>

<script src="./js/bootstrap.min.js"></script>

<script src="./js/slick.min.js"></script>

<script src="./js/nouislider.min.js"></script>

<script src="./js/jquery.zoom.min.js"></script>

<script src="./js/main.js"></script>

<script src = "./js/jquery-ui-1.10.4/js/jquery-1.10.2.js"></script>

<script src = "./js/jquery-ui-1.10.4/js/jquery-ui-1.10.4.custom.js"></script>

<script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>

<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>

<script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>

<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.colVis.min.js"></script>

<script>

    $(document).ready(function () {

        $('.adminDataTableFiltroFecha').DataTable({

            'language': {

                "sProcessing": "Procesando...",

                "sLengthMenu": "Mostrar _MENU_ registros",

                "sZeroRecords": "No se encontraron resultados",

                "sEmptyTable": "Ningún dato disponible en esta tabla",

                "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",

                "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",

                "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",

                "sInfoPostFix": "",

                "sSearch": "Buscar:",

                "sUrl": "",

                "sInfoThousands": ",",

                "sLoadingRecords": "Cargando...",

                "oPaginate": {

                    "sFirst": "Primero",

                    "sLast": "Último",

                    "sNext": "Siguiente",

                    "sPrevious": "Anterior"

                },

                "oAria": {

                    "sSortAscending": ": Activar para ordenar la columna de manera ascendente",

                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"

                }



            },

            'buttons': [

                'colvis'

            ],

            'order':[[5, "desc"]]

        });

    });

    $(document).ready(function () {

        $('.adminDataTableFiltroNombre').DataTable({

            'language': {

                "sProcessing": "Procesando...",

                "sLengthMenu": "Mostrar _MENU_ registros",

                "sZeroRecords": "No se encontraron resultados",

                "sEmptyTable": "Ningún dato disponible en esta tabla",

                "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",

                "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",

                "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",

                "sInfoPostFix": "",

                "sSearch": "Buscar:",

                "sUrl": "",

                "sInfoThousands": ",",

                "sLoadingRecords": "Cargando...",

                "oPaginate": {

                    "sFirst": "Primero",

                    "sLast": "Último",

                    "sNext": "Siguiente",

                    "sPrevious": "Anterior"

                },

                "oAria": {

                    "sSortAscending": ": Activar para ordenar la columna de manera ascendente",

                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"

                }



            },

            'buttons': [

                'colvis'

            ],

            'order':[[1, "asc"]]

        });

    });

</script>

<script>

    $('#tablaListadoAdmin').on('click', '.adminBotonEliminarListado', function () {

        var valores = $(this).data('bind').split('-');

        var id = valores[0];

        var nombreModal = valores[1];

        abrirModal(nombreModal);

        $('#modalIdEliminar').val(id);



    });

</script>

<script>

    function abrirModal(nombreModal) {

        $("#modal-eliminar-" + nombreModal).toggle();

        $("#modal-eliminar-" + nombreModal).dialog({

            modal: true,

            title: nombreModal,

            show: "fade",

            hide: "fade"

        });

    }

</script>

<script>

    $('#tablaListadoAdmin').on('change', '#campoAprobacion', function () {

        var idOpinion = $(this).data('bind');

        var aprobado = $(this).val();

        var datos = {'idOpinion' : idOpinion, 'aprobacion' : aprobado};

        $.ajax({

            type: 'post',

            url: 'admin/ajaxAprobacionComentario.php',

            data: datos,

            success: function (data) {

                console.log(data);

            }

        });

    });





</script>