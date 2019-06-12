<?php

require 'acciones/Conexion.php';

require 'controlador/userController.php';

require 'model/usuario.php';

require 'acciones/Lectura.php';

require 'acciones/Escritura.php';

require 'funciones/funciones.php';

require 'model/objetoProducto.php';



session_start();

if (isset($_SESSION['usuario'])) {



    $conexion = new Conexion();

    $lectura = new Lectura($conexion);

    $escritura = new Escritura($conexion);

    $userController = new userController($lectura, $escritura);

    $direccionesGuardadas = $userController->getDirecciones($_SESSION['usuario']->getIdUsuario());

    $metodosDePago = $userController->getMetodosDePago($_SESSION['usuario']->getIdUsuario());

    $objetos = $_SESSION['usuario']->getCarrito();

    $disabled = (empty($metodosDePago) && empty($direccionesGuardadas)) ? 'disabled' : '';

    ?>

    <!DOCTYPE html>

    <html lang="en">

        <?php require_once 'includes/head.php'; ?>

        <body>

            <!-- HEADER -->

            <?php require_once 'includes/header.php'; ?>

            <!-- /HEADER -->

            <div class="section">

                <!-- container -->

                <div class="container">

                    <!-- row -->

                    <div class="row">

                        <!-- section-title -->

                        <div class="col-lg-12 col-xs-12 col-md-12 text-center">

                            <h1><span style="color: #ff9f00;">Check</span>out</h1>

                        </div>

                        <div class="col-lg-12 col-xs-12 col-md-12 separador"></div>

                        <?php if (!empty( $_SESSION['usuario']->getCarrito())) { ?>

                            <div class="col-lg-8 col-xs-12 col-md-8">

                                <form action="forms-action/formFinalizarCompra.php" method="post">

                                    <div class="form-group col-lg-8 col-xs-8 col-md-8">

                                        <label>Direccion</label>

                                        <?php if(!empty($direccionesGuardadas)){ ?>

                                        <select name="idDireccion" class="form-control" required="">

                                            <?php

                                            foreach ($direccionesGuardadas as $direccion) {

                                                echo '<option value="' . $direccion['idDireccion'] . '">' . $direccion['alias'] . '</option>';

                                            }

                                            ?>

                                        </select>

                                    <?php } else {

                                        echo '<div class="alert alert-warning">Debes de registar una dirección primero</div>';

                                    } ?>

                                    </div>

                                    <div class="form-group col-lg-8 col-xs-8 col-md-8">

                                        <label>Método de pago</label>

                                        <?php if(!empty($metodosDePago)){ ?>

                                        <select name="idTarjetaCredito" class="form-control" required="">

                                            <?php

                                            foreach ($metodosDePago as $metodos) {

                                                echo '<option value="' . $metodos['idTarjetaCredito'] . '">' . $metodos['tipo'] . '</option>';

                                            }

                                            ?>

                                        </select>

                                         <?php } else {

                                        echo '<div class="alert alert-warning">Debes de registar una tarjeta de crédito primero</div>';

                                    } ?>

                                    </div>



                                    <div class="form-group col-lg-6 col-xs-6 col-md-6">

                                        <button type="submit" class="btn primary-btn <?php echo $disabled ?> ">Realizar pedido</button>

                                    </div>

                                </form>

                            </div>

                            <div class="col-lg-4 col-xs-12 col-md-4">

                                <div class="h1">Carrito</div>

                                <div class="col separador"></div>

                                <div class="col">

                                    <?php

                                    echo pintarProductosCarrito();

                                    ?>

                                </div>

                            </div>

                            <?php

                        } else {

                            if (isset($_GET['fin'])) {

                                ?>

                                <div class="col-lg-12 col-xs-12 col-md-12 alert-success alert" role="alert">Tu compra se ha efectuado.</div>

                            <?php } else { ?>

                                <div class="col-lg-12 col-xs-12 col-md-12 alert-warning alert" role="alert">Tu carrito está vacío.</div>

                            <?php } ?>





                        <?php } ?>

                    </div>

                </div>

                <!-- /container -->

            </div>

            <?php require_once 'includes/footer.php'; ?>

            <!-- /FOOTER -->

            <!-- jQuery Plugins -->

            <?php require_once 'includes/footerScripts.php'; ?>



        </body>



    </html>

    <?php

} else {

    header('Location: /');

}    