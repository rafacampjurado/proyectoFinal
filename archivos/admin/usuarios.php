<?php

require '../model/objetoProducto.php';

require '../controlador/productoController.php';

require '../controlador/userController.php';

require '../views/usuarioView.php';

require '../model/usuario.php';

require '../acciones/Conexion.php';

require '../acciones/Lectura.php';

require '../acciones/Escritura.php';

require '../funciones/funciones.php';

session_start();

$conexion = new Conexion();

$lectura = new Lectura($conexion);



if (isset($_SESSION['usuario'])) {

    if ($_SESSION['usuario']->getRol() == 'admin') {

        $conexion = new Conexion();

        $lectura = new Lectura($conexion);

        $escritura = new Escritura($conexion);

        $controlador = new userController($lectura, $escritura);

        //////////////////////////////////////////////////////////////////////////////

        $idUsuario = (isset($_GET['id']) ? $_GET['id'] : null); // Recogemos el ID si procede

        $editar = (isset($_GET['editar'])) ? true : false; // Recogemos el EDITAR si procede

        $listar = (isset($_GET['listar'])) ? true : false;

        ///////////////////////////////////////////////////////////////////////

        $accion_nuevo = false;

        $accion_editar = false;

        $accion_listar = false;

        ////////////////////////////////////////////////////////////////////////

        if ($editar) {

            $accion_editar = true;

        } else if ($listar) {

            $accion_listar = true;

        }

        /////////////////////////////////////////////////////////////////////////

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

                    <div class="section">

                        <div class="container">

                            <div class="row">



                                <?php

                                if ($accion_editar) {

                                    echo $controlador->adminEditarUsuario($idUsuario);

                                } else if ($accion_listar) {

                                    echo $controlador->listadoUsuarios();

                                } else if (!$accion_nuevo && !$accion_editar && !$accion_listar) {

                                    echo $controlador->listadoUsuarios();

                                }

                                ?>

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

