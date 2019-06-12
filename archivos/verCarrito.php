<?php
include('funciones/funciones.php');



require_once('model/objetoProducto.php');



require_once('model/usuario.php');



session_start();



//Aquí estarán los detalles del producto

if (isset($_SESSION['usuario'])) {



    $idUsuario = $_SESSION['usuario']->getIdUsuario();



    $finalizar = $_GET["fin"];



    if (isset($_GET['error'])) {



        $error = '<div class="alert alert-danger" role="alert">Error</div>';
    }
    ?>



    <!DOCTYPE html>



    <html lang="en">



    <?php require_once 'includes/head.php'; ?>



        <body>



            <!-- HEADER -->



    <?php require_once 'includes/header.php'; ?>



            <!-- /HEADER -->



            <!-- NAVIGATION -->



            <!-- /NAVIGATION -->



            <!-- BREADCRUMB -->



            <!-- /BREADCRUMB -->



            <!-- section -->



            <div class="section">



                <!-- container -->



                <div class="container">



                    <!-- row -->



                    <div class="row">



                        <div id="listado"class="col-md-12 col-xs-12 col-lg-12">



                            <!--  Product Details -->



    <?php
    if (!empty($_SESSION['usuario']->getCarrito()) || isset($finalizar) || isset($error)) {



        if (isset($error)) {



            echo $error;
        } else {



            if ($finalizar == "fin") {
                ?>



                                        <div class="alert alert-success" role="alert">



                                            Se ha realizado correctamente la compra.



                                        </div>



                                        <?php
                                    } else {
                                        ?>



                                        <div class="h1 text-center">



                                            Listado de productos



                                        </div>



                                        <div class="col-xs-12 col-md-12 col-lg-12">



                                            <table class="table text-center">



                                                <tr>



                                                    <th scope="col">Imagen</th>



                                                    <th scope="col">Producto</th>



                                                    <th scope="col">Precio</th>



                                                    <th scope="col">Tipo</th>



                                                    <th scope="col">Cantidad</th>



                                                    <th scope="col"></th>







                                                </tr>



                <?php
                echo pintarListaCarrito();
            }
            ?>



                                        </table>



                                    </div>







            <?php if (!isset($finalizar)) { ?>



                                        <div class="col-xs-12 col-md-12 col-lg-12">



                                            <a href="checkout"<button class="primary-btn text-right">Finalizar compra</button></a>



                                        </div>



                                                <?php
                                            }
                                        }
                                    } else {
                                        ?>



                                <div class="alert alert-warning" role="alert">



                                    Tu carrito está vacío.



                                </div>



        <?php
    }
    ?>



                        </div>



                        <!-- /Product Details -->



                    </div>



                    <!-- /row -->



                </div>



                <!-- /container -->



            </div>



            <!-- /section -->



            <!-- section -->



            <!-- /section -->







            <!-- FOOTER -->



    <?php require_once 'includes/footer.php'; ?>



            <!-- /FOOTER -->



            <!-- jQuery Plugins -->



    <?php require_once 'includes/footerScripts.php'; ?>



            <script>



                $('.incrementar').on('click', function () {



                    var idProducto = $(this).closest('.tbody-elementos').find('#idProducto').data('bind');



                    var precioProducto = $(this).closest('.tbody-elementos').find('#precioProducto').find('#precio').data('bind');



                    var cantidadProducto = $(this).closest('.tbody-elementos').find('#cantidadProducto').html();



                    var accion = 'incrementar';



                    actualizarTabla(this, accion, precioProducto, cantidadProducto, idProducto);



                    $('#sumaTotal').html(sumaTotal());



                });



                $('.disminuir').on('click', function () {



                    var idProducto = $(this).closest('.tbody-elementos').find('#idProducto').data('bind');



                    var precioProducto = $(this).closest('.tbody-elementos').find('#precioProducto').find('#precio').data('bind');



                    var cantidadProducto = $(this).closest('.tbody-elementos').find('#cantidadProducto').html();



                    var accion = 'disminuir';



                    actualizarTabla(this, accion, precioProducto, cantidadProducto, idProducto);



                    $('#sumaTotal').html(sumaTotal());



                });



                $('.borrarProducto').on('click', function () {



                    var idProducto = $(this).closest('.tbody-elementos').find('#idProducto').data('bind');



                    var accion = 'borrar';



                    actualizarTabla(this, accion, precioProducto, cantidadProducto, idProducto);



                    $('#sumaTotal').html(sumaTotal());



                });







                function actualizarTabla(fila, accion, precioProducto, cantidadProducto, idProducto) {







                    if (accion === 'incrementar' || accion === 'disminuir') {



                        if (accion === 'incrementar') {



                            var cantidad = parseInt(cantidadProducto) + 1;



                        } else {



                            var cantidad = parseInt(cantidadProducto) - 1;



                            if (cantidad === 0) {



                                cantidad = 1;



                            }



                        }



                        var precio = (precioProducto * cantidad).toFixed(2);



                        $(fila).closest('tbody').find('#precioProducto').find('#precio').html(precio);



                        $(fila).closest('tbody').find('#cantidadProducto').html(cantidad);



                    } else {



                        $(fila).closest('.tbody-elementos').remove();



                    }



                    var datosAjax = {

                        'idProducto': idProducto,

                        'accion': accion



                    };



                    $.ajax({

                        url: 'ajaxActualizarCarrito.php',

                        type: 'post',

                        data: datosAjax,

                        success: function (data) {



                            var carrito = pintarCarritoHeader(data);



                            $('.shopping-cart-list').html(carrito);



                        }



                    });







                }



                function sumaTotal() {



                    var elementos = $('.tbody-elementos').find('#precio');



                    var total = 0;



                    elementos.each(function () {



                        total += parseFloat($(this).html());



                    });



                    return total.toFixed(2);



                }











            </script>



        </body> 



    </html>

    <?php
} else {

    header('Location: /');
}



