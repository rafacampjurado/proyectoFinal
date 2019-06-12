<?php

require 'model/objetoProducto.php';

require 'controlador/productoController.php';

require 'controlador/userController.php';

require 'model/usuario.php';

require 'acciones/Conexion.php';

require 'acciones/Lectura.php';

require 'acciones/Escritura.php';

require 'funciones/funciones.php';

session_start();

$conexion = new Conexion();

$lectura = new Lectura($conexion);



$ultimosProductosVendidos = $lectura->getUltimosProductosVendidos();

$productos = ultimosProductosVendidos($ultimosProductosVendidos);

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

                <!-- home wrap -->

                <div class="col-lg-10 col-sm-12 col-xs-12 text-center col-lg-offset-1  ">

                    <!-- home slick -->

                    <div id="home-slick">

                        <!-- banner -->

                        <div class="banner banner-1">

                            <img src="./img/banerFruta.jpg" alt="Frutas">

                            <div class="banner-caption text-center">

                                <h1 style="color: White">Frutas</h1>

                                <!--<h3 class="white-color font-weak">Frutas</h3>-->

                                <button class="primary-btn"><a href="productos/Fruta">Comprar ahora</a></button>

                            </div>

                        </div>

                        <!-- /banner -->

                        <div class="banner banner-1">

                            <img src="./img/bannerCarnes.jpg" alt="">

                            <div class="banner-caption text-center">

                                <h1 style="color: White">Carnes</h1>

                                <!--<h3 class="white-color font-weak">Texto2</h3>-->

                                <button class="primary-btn"><a href="producto/Carne">Comprar</a></button>

                            </div>

                        </div>

                        <!-- banner -->

                        <div class="banner banner-1">

                            <img src="./img/bannerSnacks.jpg" alt="">

                            <div class="banner-caption text-center">

                                <h1 style="color: White">Aperitivos</h1>

                                <!--<h3 class="white-color font-weak">Texto2</h3>-->

                                <button class="primary-btn"><a href="productos/Aperitivos">Comprar ahora</a></button>

                            </div>

                        </div>

                        <div class="banner banner-1">

                            <img src="./img/bannerHortalizas.jpg" alt="">

                            <div class="banner-caption text-center">

                                <h1 style="color: White">Hortalizas</h1>

                                <!--<h3 class="white-color font-weak">Texto2</h3>-->

                                <button class="primary-btn"><a href="productos/Hortaliza">Comprar ahora</a></button>

                            </div>

                        </div>

                        <div class="banner banner-1">

                            <img src="./img/bannerDulces.jpg" alt="">

                            <div class="banner-caption text-center">

                                <h1 style="color: white">Dulces</h1>

                                <!--<h3 class="white-color font-weak">Texto2</h3>-->

                                <button class="primary-btn"><a href="productos/Dulce">Comprar ahora</a></button>

                            </div>

                        </div>

                        <div class="banner banner-1">

                            <img src="./img/bannerPescado.jpg" alt="">

                            <div class="banner-caption text-center">

                                <h1 style="color: white">Pescado</h1>

                                <!--<h3 class="white-color font-weak">Texto2</h3>-->

                                <button class="primary-btn"><a href="productos/Pescado">Comprar ahora</a></button>

                            </div>

                        </div>

                        <!-- /banner -->

                        <!-- banner -->

                        <!-- /banner -->

                    </div>

                    <!-- /home slick -->

                </div>

                <!-- /home wrap -->

            </div>

            <!-- /container -->

        </div>

        <!-- /HOME -->

        <!-- section -->

        <div class="section">

            <!-- container -->

            <div class="container">

                <!-- row -->

                <div class="row">

                    <!-- section-title -->

                    <div class="col-md-12">

                        <div class="section-title">

                            <h2 class="title">Últimos productos vendidos</h2>

                            <div class="pull-right">

                                <div class="product-slick-dots-1 custom-dots"></div>

                            </div>

                        </div>

                    </div>

                    <!-- /section-title -->

                    <!-- Product Slick -->

                    <div class="col-md-10 col-sm-6 col-xs-6 col-lg-12 col-xs-offset-3 col-lg-offset-0">

                        <div class="row" id="ultimosProductosVendidos">

                            <div id="product-slick-1" class="product-slick" >

                                <!-- Product Single -->

                                <?php

                                echo $productos;

                                ?>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <!-- /container -->

        </div>

        <?php require_once './includes/footer.php'; ?>

        <!-- /FOOTER -->

        <!-- jQuery Plugins -->

        <?php require_once './includes/footerScripts.php'; ?>



    </body>



</html>

