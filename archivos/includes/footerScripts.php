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



    $('#datos').on('click', '.accion', function () {



        var value = $(this).val().split('-');



        var accion = value[0];



        var nombreModal = value[1];



        var idComentario = value[2];



        abrirModal(accion, nombreModal);



        if (accion == 'editar') {



            $("#datos tr").each(function () {



                var id = $(this).find("#campo-nombre").data('bind');



                var nombre = $(this).find("#campo-nombre").text();



                var texto = $(this).find("#campo-texto").text();



                var puntuacion = $(this).find("#campo-puntuacion").data('bind');



                if (id == idComentario) {



                    listado = {



                        "nombre": nombre,



                        "texto": texto,



                        "puntuacion": puntuacion,



                        "idComentario": id



                    };



                }



            });



            $('#modal-' + accion + '-' + nombreModal + ' #formNombreProducto').val(listado["nombre"]);



            $('#modal-' + accion + '-' + nombreModal + ' #formComentarioProducto').val(listado["texto"]);



            $('#modal-' + accion + '-' + nombreModal + ' #formPuntuacionProducto').val(listado["puntuacion"]);



        }



        $('#modal-' + accion + '-' + nombreModal + ' #formIdOpinion').val(parseInt(idComentario));











    });



</script>



<script>



    function abrirModal(accion, nombreModal) {



        $("#modal-" + accion + '-' + nombreModal).toggle();



        $("#modal-" + accion + '-' + nombreModal).dialog({



            modal: true,



            title: nombreModal,



            show: "fade",



            hide: "fade"



        });



    }



</script>



<script>



    $('#enviarForm').on('click', function () {



        var textOpinion = $('#formComentarioProducto').val();



        var puntuacion = $('#formPuntuacionProducto').val();



        var idComentario = $('#formIdOpinion').val();



        var datosFormulario = {



            "textOpinion": textOpinion,



            "puntuacion": puntuacion,



            "idComentario": idComentario



        };



        $.ajax({



            type: 'post',



            url: 'ajaxEditComentarioUser.php',



            data: datosFormulario,



            success: function (data) {



                listarDatos();



            }



        });



    });







</script>



<script>



    $('.botonAñadirNuevo').on('click', function () {



        var tipoAccion = ($(this).val());



        var accion = "#modal-nueva-" + tipoAccion;



        $(accion).toggle();



        if (tipoAccion === 'tarjeta') {



            $(accion).dialog({



                modal: true,



                title: 'AÑADIR ' + tipoAccion.toUpperCase(),



                show: "puff",



                hide: "scale",



                width: 231



            });



        } else {



            $(accion).dialog({



                modal: true,



                title: 'AÑADIR ' + tipoAccion.toUpperCase(),



                show: "puff",



                hide: "scale",



                width: 209



            });



        }







    });



</script>



<script>



    $(document).ready(function () {



        $('#tablaComentarios').DataTable({



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

            'order':[[4, "desc"]]



        });



    });



</script>



<script>



    $('#imagen-usuario').on('click', function () {



        $('.imagenUsuario').click();



    });



</script>



<script>



    function enviarImagen() {



        $('form input').css({'background-color': '#eee', 'cursor': 'not-allowed'});



        $('#botonEnviarFoto').click();



    }



</script>



<script>



    function desbloquearCampo(name) {



        $('input[name="' + name + '"]').prop('disabled', false);



        $('#enviarFormEditarUsuario').css({'display': 'grid', 'width': '100%'});



        $('input[name="' + name + '"]').css({



            'box-shadow': '0px 0px 12px 1px #1ee61e ',



            'cursor': 'default',



            'background-color': 'white'



        });



    }



</script>



<script>



    function enviarDatosForm() {



        $('form input').css({'background-color': '#eee', 'cursor': 'not-allowed'});



        $('input[name="nombreUsuario"]').prop('disabled', false);



        $('input[name="apellidosUsuario"]').prop('disabled', false);



        $('input[name="enviarFormEditarUsuario"]').click();







    }



</script>



<script>



    function pintarCarritoHeader(elementosCarrito) {



        var resultado = '';



        var elementos = jQuery.parseJSON(elementosCarrito);



        var cantidadProductos = elementos.length;



        var precioProductos = 0;



        elementos.forEach(function (elemento) {



            var imagen = elemento['img'];



            var precio = parseFloat(elemento['precio']);



            var nombre = elemento['nombre'];



            var cantidad = parseInt(elemento['cantidad']);



            var idProducto = elemento['idProduct'];



            precioProductos += precio * cantidad;



            resultado += '<div class="product product-widget col-xs-12 col-md-12 col-lg-12">';



            resultado += '<div class="product-thumb">';



            resultado += '<img src="' + imagen + '" alt="">';



            resultado += '</div>';



            resultado += '<div class="product-body">';



            resultado += '<h3 class="product-price">' + precio + ' €</h3>';



            resultado += '<h2 class="product-name"><a href="#">' + nombre + ' (' + cantidad + ') </a></h2>';



            resultado += '</div>';



            resultado += '<a href="accion-carrito/' + idProducto + '/borrar"<button id="' + idProducto + '" class="cancel-btn"><i class="fa fa-trash"></i></button></a>';



            resultado += '</div>';



        });



        $('.sumaProductos').html(precioProductos.toFixed(2) + '€');



        $('.cantidadProductos').html(cantidadProductos);







        return resultado;



    }



</script>