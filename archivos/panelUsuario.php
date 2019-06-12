<?php
require 'model/objetoProducto.php';
require 'acciones/Conexion.php';
require 'acciones/Lectura.php';
require 'acciones/Escritura.php';
require 'funciones/funciones.php';
require 'views/userPanelViews.php';
require 'controlador/userController.php';
require 'model/usuario.php';

session_start();

$conexion = new Conexion();

$lectura = new Lectura($conexion);

$escritura = new Escritura($conexion);

$controller = new userController($lectura, $escritura);

if (isset($_SESSION['usuario'])) {

$accion = (isset($_GET['accion'])) ? $_GET['accion'] : false;

$idUsuario = $_SESSION['usuario']->getIdUsuario();

    ?>

    <!DOCTYPE html>

    <html lang="en">



        <?php require_once './includes/head.php'; ?>

        <body>

            <!-- HEADER -->

            <?php require_once './includes/header.php'; ?>

            <!-- /HEADER -->



            <!-- /HOME -->

            <!-- section -->

            <div class="section">

                <!-- container -->

                <div class="container">

                    <div class="row">

                        <div class="col-md-3 col-xs-12 col-lg-3" id="columnaOpciones">

                            <div class="h2 text-center">Opciones</div>

                            <div class="col-md-2 col-xs-12 col-lg-12 col-lg-offset-1 col-xs-offset-0 col-md-offset-1">

                                <ul class="header-btns-icon">

                                    <li class="btn btn-primary btn-max opcionesUsuario" data-bind="listado-facturas"><span class="fa fa-file-text btn"></span >

                                        <span class="opcion">Facturas</span></li>

                                    <li class="btn btn-primary btn-max opcionesUsuario" data-bind="datos-personales"><span class="fa fa-address-book btn"></span>

                                        <span class="opcion">Datos personales</span></li>

                                    <li class="btn btn-primary btn-max opcionesUsuario" data-bind="comentarios"><span class="fa fa-quote-left btn"></span>

                                        <span class="opcion">Comentarios</span></li>

                                    <li class="btn btn-primary btn-max opcionesUsuario" data-bind="metodos-de-pago"><span class="fa fa-credit-card btn"></span>

                                        <span class="opcion">Métodos de pago</span></li>

                                </ul>

                            </div>

                        </div>

                        <div class="col-md-9 col-xs-12 col-lg-9" id="datos">

                            <?php

                            switch ($accion) {

                                case 'datos-personales':

                                    $controller->datosPersonales($idUsuario);

                                    break;

                                case 'listado-facturas':

                                    $controller->listadoFacturasUsuario($idUsuario);

                                    break;

                                case 'comentarios':

                                    $controller->listadoComentariosUsuario($idUsuario);

                                    break;

                                case 'metodos-de-pago':

                                    $controller->listadoMetodosPagosUsuario($idUsuario);

                                    break;

                                default:

                                    $controller->datosPersonales($idUsuario);

                                    break;

                            }

                            ?>

                        </div>

                    </div>

                </div>

                <!-- /container -->

            </div>

            <?php require_once './includes/footer.php'; ?>

            <!-- /FOOTER -->

            <!-- jQuery Plugins -->

            <?php require_once './includes/footerScripts.php'; ?>

            <script>

                $('.opcionesUsuario').on('click', function () {

                    var values = $(this).data('bind');
                    var urlActual = $(location).attr('pathname');
                    var url = 'panel-usuario' + '/' + values;
                    location.href = url;

                });

            </script>

        </body>



    </html>

    <?php

} else {

    header('Location: registro');

}