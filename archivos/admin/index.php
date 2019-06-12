<?php

require '../model/objetoProducto.php';

require '../controlador/productoController.php';

require '../controlador/userController.php';

require '../model/usuario.php';

require '../acciones/Conexion.php';

require '../acciones/Lectura.php';

require '../acciones/Escritura.php';

require '../funciones/funciones.php';

session_start();

$conexion = new Conexion();

$lectura = new Lectura($conexion);



$ultimosProductosVendidos = $lectura->getUltimosProductosVendidos();

$productos = ultimosProductosVendidos($ultimosProductosVendidos);

if (isset($_SESSION['usuario'])) {

    if ($_SESSION['usuario']->getRol() == 'admin') {

        ?>

        <!DOCTYPE html>

        <html lang="en">

            <?php require_once './includes/head.php'; ?>

            <body>

                <!-- HEADER -->

                <?php require_once './includes/header.php'; ?>

                <!-- /HEADER -->



                <div id="home">

                    <!-- container -->

                    <div class="container">

                        <div class="section">

                            <div class="h1 text-center">Bienvenido a la administración</div>

                                <div class="col-md-4 col-sm-4 col-xs-4 col-lg-4">

                                    <div class="product product-single">

                                        <div class="product-thumb">

                                            <a href="admin/usuarios"><button class="main-btn quick-view"><i class="fa fa-pencil"></i> Usuarios</button></a>

                                            <img src="../../img/bannerUsuario.jpg" alt="">

                                        </div>

                                    </div>

                            </div>

                            <div class="col-md-4 col-sm-4 col-xs-4 col-lg-4">

                                    <div class="product product-single">

                                        <div class="product-thumb">

                                            <a href="admin/productos"><button class="main-btn quick-view"><i class="fa fa-pencil"></i> productos</button></a>

                                            <img src="../../img/bannerCarrito.jpg" alt="">

                                        </div>

                                    </div>

                            </div><div class="col-md-4 col-sm-4 col-xs-4 col-lg-4">

                                    <div class="product product-single">

                                        <div class="product-thumb">

                                            <a href="admin/comentarios"><button class="main-btn quick-view"><i class="fa fa-pencil"></i> comentarios</button></a>

                                            <img src="../../img/bannerComment.jpg" alt="">

                                        </div>

                                    </div>

                            </div>

                        </div>

                    </div>

                    <!-- /container -->

                </div>

                <!-- /HOME -->

                <!-- section -->

                <?php require_once './includes/footer.php'; ?>

                <!-- /FOOTER -->

                <!-- jQuery Plugins -->

                <?php require_once './includes/footerScripts.php'; ?>



            </body>



        </html>

        <?php

    } else {

        header('Location: ../');

    }

} else {

    header('Location: ../');

}

