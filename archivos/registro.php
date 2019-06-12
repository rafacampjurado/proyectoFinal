<?php

session_start();

include("funciones/funciones.php");

require_once("model/objetoProducto.php");

require_once("model/usuario.php");

if (!isset($_SESSION['usuario'])) {

    ?>

    <!DOCTYPE html>

    <html lang="en">



    <?php require_once './includes/head.php'; ?>



        <body>

            <!-- HEADER -->

            <?php require_once './includes/header.php'; ?>

            <?php

            if (isset($_GET['error'])) {

                $texto = '<div class="alert alert-danger text-center" role="alert">El nombre de usuario o el correo electrónico ya existe</div>';

                $aviso = 'alert alert-danger';

            } else {

                $texto = "";

                $aviso = "";

            }

            ?>

            <!-- /HEADER -->





            <!-- /HOME -->



            <!-- section -->

            <div class="section">



                <!-- container -->

                <div class="container">

                    <div class="h1 text-center">Registro</div>

                    <!-- row -->

    <?php if (!isset($_GET['fin'])) { ?>

                        <form action="forms-action/formRegistro.php" method="post" enctype="multipart/form-data">

                            <input type="text" value="registrar" hidden="">

                            <legend>Datos sobre la cuenta</legend>

                            <?php

                            echo $texto;

                            ?>

                            <div class="form-group text-left <?php echo $aviso ?>">

                                <label for="email">Correo Electrónico</label>

                                <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="prueba@prueba.prueba" required>

                                <small id="emailHelp" class="form-text text-muted">Este correo debe de ser válido.</small>

                            </div>

                            <div class="form-group text-left <?php echo $aviso ?>">

                                <label for="usuario">Usuario</label>

                                <input type="text" name="usuario" class="form-control" id="usuario" placeholder="Antonio359" required>

                                <small id="emailHelp" class="form-text text-muted">Este será el nombre con el que iniciará sesión</small>

                            </div>

                            <div class="form-group">

                                <label for="contraseña">Contraseña</label>

                                <input type="password" name="contraseña"class="form-control" id="contraseña" placeholder="contraseña" required>

                            </div>

                            <legend>Datos personales</legend>

                            <div class="form-group">

                                <label for="nombre">Nombre</label>

                                <input type="text" name="nombre" class="form-control" id="usuario" placeholder="Antonio">



                            </div>

                            <div class="form-group">

                                <label for="apellidos">Apellidos</label>

                                <input type="text" name="apellidos" class="form-control" id="apellidos" placeholder="Sánchez">



                            </div>

                            <div class="form-group">

                                <label for="apellidos">Imagen de perfil</label>

                                <input type="file" name="imagenPerfil" class="form-control" id="imagenPerfil" accept="image/png, image/jpeg">



                            </div>

                            <div class="form-check">

                                <label class="form-check-label">

                                    <input type="checkbox" class="form-check-input" required>

                                    Acepta los términos.

                                </label>

                            </div>

                            <button type="submit" class="btn btn-primary">Registrar</button>

                        </form>

                        <?php

                    } else {

                        ?>

                        <div class="alert alert-success ">El registro se ha completado</div>

                        <div class="alert alert-info ">Puedes iniciar sesión ahora haciendo <a href="inicioSesion.php">clic aquí</a></div>

    <?php } ?>

                    <!-- /row -->

                </div>

                <!-- /container -->

            </div>

            <!-- /section -->



            <!-- section -->



            <!-- /section -->



            <!-- section -->



            <!-- /section -->



            <!-- section -->



            <!-- /section -->



            <!-- FOOTER -->

    <?php require_once './includes/footer.php'; ?>

            <!-- /FOOTER -->



            <!-- jQuery Plugins -->

            <script src="js/jquery.min.js"></script>

            <script src="js/bootstrap.min.js"></script>

            <script src="js/slick.min.js"></script>

            <script src="js/nouislider.min.js"></script>

            <script src="js/jquery.zoom.min.js"></script>

            <script src="js/main.js"></script>



        </body>

        <?php

    } else {

        header("location: index.php");

    }

    ?>

</html>

