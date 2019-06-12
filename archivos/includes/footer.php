<footer id="footer" class="footer section-grey clearfix ">

    <!-- container -->

    <div class="container">

        <!-- row -->

        <div class="row text-center">

            <!-- footer widget -->

            <div class="col-md-3 col-sm-6 col-xs-12">

                <div class="footer">

                    <!-- footer logo -->

                    <div class="footer-logo">

                        <a class="logo" href="#">

                            <img src="./img/logo.png" alt="">

                        </a>

                    </div>

                    <!-- /footer logo -->



                    <p>Página web creada para la asginatura de Desarrollo Web en Entorno Servidor</p>



                    <!-- footer social -->

                    <ul class="footer-social">

                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>

                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>

                        <li><a href="#"><i class="fa fa-instagram"></i></a></li>

                        <li><a href="#"><i class="fa fa-google-plus"></i></a></li>

                        <li><a href="#"><i class="fa fa-pinterest"></i></a></li>

                    </ul>

                    <!-- /footer social -->

                </div>

            </div>

            <!-- /footer widget -->



            <!-- footer widget -->

            <div class="col-md-3 col-sm-3 col-xs-6">

                <div class="footer">

                    <h3 class="footer-header">Cuenta</h3>

                    <ul class="list-links">

                        <li><a href="panel-usuario">Mi cuenta</a></li>

                        

                    </ul>

                </div>

            </div>

            <!-- /footer widget -->



            <!--<div class="clearfix visible-sm visible-xs"></div>-->



            <!-- footer widget -->

            <div class="col-md-3 col-sm-3 col-xs-6">

                <div class="footer">

                    <h3 class="footer-header">Información</h3>

                    <ul class="list-links">

                        <li><a href="#">Sobre nosotros</a></li>

                        <li><a href="#">Guia de compra  </a></li>

                        <li><a href="#">FAQ</a></li>

                    </ul>

                </div>

            </div>

            <!-- /footer widget -->



            <!-- footer subscribe -->

            <div class="col-md-3 col-sm-12 col-xs-12">

                <div class="footer text-center">

                    <?php

                    if (!isset($_SESSION['usuario'])) {

                        ?>

                        <h3 class="footer-header">¿Ya tienes cuenta?</h3>  

                        <form action="funciones/logUser.php" method="post">  

                            <div class="form-group text-center">

                                <div class="form-group  col-xs-6">

                                    <label for="usuario">Usuario</label>

                                    <input type="text" name="usuario" class="form-control" id="usuario" placeholder="Antonio359" required>

                                </div>

                                <div class="form-group  col-xs-6">

                                    <label for="contraseña">Contraseña</label>

                                    <input type="password" name="contraseña"class="form-control" id="contraseña" placeholder="contraseña" required>

                                </div>

                                <button type="submit" class="btn btn-primary">Iniciar sesión</button>

                        </form>

                    <?php } else {

                        ?>

                        <h3 class="footer-header"><?php echo "Bienvenido " . $_SESSION['usuario']->getUsuario(); ?> </h3>

                        <ul class="list-links">

                            <li><a href="cerrar-sesion">Cerrar Sesión </a> </li>

                        </ul>

                        <?php

                    }

                    ?>



                </div>

            </div>

            <!-- /footer subscribe -->

        </div>

        <!-- /row -->

        <hr>

        <!-- row -->

        <!-- /row -->

    </div>

    <!-- /container -->

</footer>