<header>



    <!-- top Header -->



    <?php



    if (isset($_SESSION['usuario'])) {



        ?>



        <div id="top-header">



            <div class="container">



                <div class="pull-left ">







                    <?php



                    if (isset($_SESSION['usuario'])) {



                        echo "<span>Bienvenido " . $_SESSION['usuario']->getUsuario() . "</span>";



                    }



                    ?>                                       







                </div>



            </div>



        </div>



    <?php } ?>



    <!-- /top Header -->







    <!-- header -->



    <div id="header">



        <div class="container">



            <div class="pull-left">



                <!-- Logo -->



                <div class="header">



                    <!--                            <a class="logo" href="#">-->



                    <a href="/"><img class="img-responsive" src="./img/logo.png" alt=""></a>



                    <!--</a>-->



                </div>



                <!-- /Logo -->







                <!-- Search -->







                <!-- /Search -->



            </div>







            <div class="pull-right col-lg-5 col-md-6 col-sm-12 col-xs-12">



                <ul class="header-btns">



                    <li class="nav-toggle">



                        <button class="nav-toggle-btn main-btn icon-btn"><i class="fa fa-bars"></i></button>



                    </li>



                    <!-- Account -->



                    <li class="header-account dropdown default-dropdown">



                        <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">



                            <div class="header-btns-icon">



                                <?php



                                if (isset($_SESSION['usuario'])) {



                                  /*  echo '<img src="./img/user-images/' . $_SESSION['usuario']->getIdUsuario() . '-' . $_SESSION['usuario']->getImagen() . '" class="imagenPerfil">';*/
                                    echo ($_SESSION['usuario']->getImagen() != 'default.png') ?
                                     '<img src="./img/user-images/' . $_SESSION['usuario']->getIdUsuario() . '-' . $_SESSION['usuario']->getImagen() . '" class="imagenPerfil">' 
                                     : '<img src="./img/user-images/default.png" class="imagenPerfil" >';



                                } else {



                                    ?>



                                    <i class="fa fa-user"></i>



                                <?php } ?>



                            </div>



                            <strong class="text-uppercase">Cuenta</strong>



                            <i class="fa fa-caret-down"></i>



                        </a><div></div><div></div><div></div>



                        <div class="custom-menu menuUsuario">



                            <ul>



                                <?php



                                if (!isset($_SESSION['usuario'])) {



                                    echo '<li><a href="iniciar-sesion" class="text-uppercase">Iniciar sesión</a></li>'



                                    . '<li><a href="registro" class="text-uppercase">Registro</a></li>';



                                } else {



                                    ?>



                                    <li><a href="/">inicio</a></li>



                                    <li><a href="panel-usuario">Mi cuenta</a></li>



                                    <?php



                                    if ($_SESSION['usuario']->getRol() == 'admin') {



                                        echo '<li><a href="admin/">Administración</a></li>';



                                    }



                                    ?>



                                    <li><a href="cerrar-sesion">Cerrar Sesión</a></li>  



                                    <?php



                                }



                                ?>



                            </ul>



                        </div>



                    </li>



                    <!-- /Account -->







                    <!-- Cart -->



                    <li class="header-cart dropdown default-dropdown">



                        <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">



                            <div class="header-btns-icon">



                                <i class="fa fa-shopping-cart"></i>



                                <!--//Cuenta de la cantidad de productos que hay-->



                                <span class="qty cantidadProductos">



                                    <?php



                                    if (isset($_SESSION['usuario'])) {



                                        echo count($_SESSION['usuario']->getCarrito());



                                    } else {



                                        echo 0;



                                    }



                                    ?>



                                </span> 



                                <!--//Cuenta de la cantidad de productos que hay-->



                            </div>



                            <strong class="text-uppercase">Carrito </strong><i class="fa fa-caret-down"></i>



                            <br>



                            <span class="sumaProductos"><?php



                                $precioSumado = sumaPrecioProductos();



                                if ($precioSumado == 0) {



                                    echo "0 €";



                                } else {



                                    echo $precioSumado . "€";



                                }



                                ?>



                            </span>



                        </a>



                        <div class="custom-menu">



                            <div id="shopping-cart">



                                <div class="shopping-cart-list">

                                    <?php



                                    if (isset($_SESSION['usuario'])) {



                                        if (count($_SESSION['usuario']->getCarrito()) > 0) {



                                            $carrito = pintarProductosCarrito();



                                            echo $carrito;



                                        }



                                    }



                                    ?>        


                                </div>



                                



                                <div class="shopping-cart-btns">



                                    <a href="cesta-de-compra" class="main-btn">Ver carrito</a>



                                    <a href="checkout" class="primary-btn">Checkout <i class="fa fa-arrow-circle-right"></i></a>



                                </div>



                            </div>



                        </div>



                    </li>



                    











                </ul>



            </div>



        </div>



        <!-- header -->



    </div>



    <!-- container -->



</header>



<?php



require './includes/nav.php';



echo "<p></p>";



