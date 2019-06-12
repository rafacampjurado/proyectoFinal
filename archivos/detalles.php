<?php

require 'model/objetoProducto.php';

require 'controlador/productoController.php';

require 'model/usuario.php';

require 'acciones/Conexion.php';

require 'acciones/Lectura.php';

require 'acciones/Escritura.php';

require 'funciones/funciones.php';

session_start();

$conexion = new Conexion();

$lectura = new Lectura($conexion);

$escritura = new Escritura($conexion);

/////////////////////////////////////////////////

$idProd = $_GET['id'];

//Aquí estarán los detalles del producto

$productoController = new productoController($lectura, $escritura);

$producto = $productoController->buscarProducto($idProd);

$idUsuario = (isset($_SESSION['usuario'])) ? $_SESSION['usuario']->getIdUsuario() : null;

$numOpiniones = $productoController->getCountOpinionesProducto($idProd);

$existeComent = $lectura->checkExisteOpinion($idUsuario, $idProd);

$paginas = pintarPaginas($numOpiniones);

$objSerializado = serialize($producto);

$errorOpinion = (isset($_GET['error'])) ? true : false;

$recetas = buscarApi($producto->nombre);

$relacionados = productosRelacionados($productoController->getProductosRelacionados($producto->getTipo()));

$opiniones = mostrarOpiniones($lectura->buscarComentarios(0, $producto->getIdProduct()));

?>

<!DOCTYPE html>

<html lang="en">

    <?php require_once './includes/head.php'; ?>

    <body>

        <!-- HEADER -->

        <?php require_once './includes/header.php'; ?>

        <!-- /HEADER -->

        <!-- section -->

        <div class="section">

            <!-- container -->

            <div class="container">

                <!-- row -->

                <div class="row">

                    <!--  Product Details -->

                    <div class="product product-details clearfix">

                        <div class="col-md-6 col-xs-4 col-lg-5 col-xs-offset-4 col-lg-offset-0 col-md-offset-0 imagenProducto" >

                            <div id="product-main-view">

                                <!--<div class="product-view">-->

                                <img src="<?php echo $producto->img; ?>" alt="">

                                <!--</div>-->

                            </div>

                        </div>

                        <div class="col-md-6 col-xs-12 col-lg-7 bodyProducto">

                            <div class="product-body">

                                <h2 class="product-name"><?php echo $producto->nombre ?></h2>

                                <h3 class="product-price"><?php echo $producto->precio . " €"; ?></h3>

                                <div>

                                    <?php if ($numOpiniones != 0) { ?>

                                        <a href="#" class="fa fa-star"> <?php echo $numOpiniones; ?> Opinion/es</a>

                                    <?php } else { ?>

                                        <a href="#" class="fa fa-star"> Este producto aún no tiene opiniones.</a>

                                        <?php

                                    }

                                    ?>

                                </div>

                                <p><strong>Disponibilidad: </strong> En Stock<br>

                                    <strong>Tipo: </strong><?php echo $producto->tipo ?><br>

                                <div class="product-options">

                                </div>

                                <div class="product-btns">

                                    <div class="qty-input">

                                        <?php

                                        if (!isset($_SESSION['usuario'])) {

                                            ?>

                                            <div class="alert alert-danger" role="alert">

                                                Debes de estar registrado para poder comprar.

                                            </div>

                                        <?php } ?>

                                        <span class="text-uppercase">Cantidad: </span>

                                        <?php

                                        if (!isset($_SESSION['usuario'])) {

                                            $disabled = 'disabled=""';

                                        } else {

                                            $disabled = "";

                                        }

                                        ?>

                                        <div id="form-añadirProducto">

                                            <input class="input" id="cantidadProducto" type="number" min="1" max="5" <?php echo $disabled ?> value="1" >

                                            <input type="text" hidden="" value="añadir" name="accion">

                                            <input type="number" hidden="" value="<?php echo $idProd ?>" id="idProducto">

                                            <textarea id="objProducto" hidden=""><?php echo $objSerializado ?></textarea>

                                            <button onclick="añadirProducto()" class="primary-btn add-to-cart" <?php

                                            if ($disabled != "") {

                                                echo 'style="cursor: not-allowed;"';

                                            }

                                            ?> ><i class="fa fa-shopping-cart"></i> Añadir al carrito</button>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="col-md-12 col-xs-12 col-lg-12">

                            <div class="product-tab">

                                <ul class="tab-nav">

                                    <li class="active"><a data-toggle="tab" href="#tab1">Descripción</a></li>

                                    <li><a data-toggle="tab" href="#tab2">Recetas</a></li>

                                    <li><a data-toggle="tab" href="#tab3">Opiniones (<?php echo $numOpiniones ?>)</a></li>

                                </ul>

                                <div class="tab-content">

                                    <div id="tab1" class="tab-pane fade in active">

                                        <p>Beetroot water spinach okra water chestnut ricebean pea catsear courgette summer purslane.

                                            <br>Water spinach arugula pea tatsoi aubergine spring onion bush tomato kale radicchio turnip chicory salsify pea sprouts fava bean.

                                            <br>Dandelion zucchini burdock yarrow chickpea dandelion sorrel courgette turnip greens tigernut soybean radish artichoke wattle seed endive groundnut broccoli arugula.</p>

                                    </div>

                                    <div id="tab2" class="tab-pane fade">

                                        <div class="col-xs-12 col-md-12 col-lg-12 listadoRecetas">

                                            <?php echo $recetas; ?>

                                        </div>

                                    </div>

                                    <div id="tab3" class="tab-pane fade in">

                                        <div class="row">

                                            <div class="col-md-6 col-xs-6 col-lg-6">

                                                <div class="product-reviews" id="comentarios">

                                                    <?php

                                                    if ($numOpiniones != 0) {



                                                        echo $opiniones;

                                                    } else {

                                                        ?> 

                                                        <h4 class="text-uppercase">Este producto aún no posee opiniones</h4>

                                                        <?php

                                                        if (!isset($_SESSION['usuario'])) {

                                                            ?>

                                                            <h5 class="text-uppercase"><a href="iniciar-sesion">Inicia sesión</a> para escribir una opinión acerca del producto</h5>

                                                            <?php

                                                        }

                                                    }

                                                    ?>

                                                </div>

                                                <input type="number" class="idProducto" id="idProducto" value="<?php echo $idProd; ?>" hidden="hidden" name="idProducto">

                                                <?php echo $paginas; ?>

                                            </div>

                                            <?php

                                            if (isset($_SESSION['usuario'])) {

                                                if (!$existeComent) {

                                                    ?>

                                                    <div class="col-md-6 col-xs-6 col-lg-6">

                                                        <h4 class="text-uppercase">Escribe una opinión</h4>

                                                        <p>Tu correo electrónico no será visible.</p>

                                                        <form id="formOpinion"class="review-form" method="POST" action="forms-action/enviar-opinion.php">



                                                            <?php

                                                            if ($errorOpinion) {

                                                                echo "<div class='alert alert-warning' role='alert'>Error</div>";

                                                            }

                                                            ?>

                                                            <div class="form-group">

                                                                <textarea class="input" placeholder="Opinión" name="opinion"></textarea>

                                                            </div>

                                                            <div class="form-group">

                                                                <div class="input-rating">

                                                                    <strong class="text-uppercase">Tu puntuación: </strong>

                                                                    <div class="stars">

                                                                        <input type="radio" id="star5" name="rating" value="5" /><label for="star5"></label>

                                                                        <input type="radio" id="star4" name="rating" value="4" /><label for="star4"></label>

                                                                        <input type="radio" id="star3" name="rating" value="3" /><label for="star3"></label>

                                                                        <input type="radio" id="star2" name="rating" value="2" /><label for="star2"></label>

                                                                        <input type="radio" id="star1" name="rating" value="1" /><label for="star1"></label>

                                                                    </div>

                                                                </div>

                                                            </div>

                                                            <input type="number" id="idProducto" value="<?php echo $producto->idProduct; ?>" hidden="hidden" name="idProducto">

                                                            <input type="submit" class="primary-btn" name="btnComentario" id="btnComentario" value="Enviar opinión">

                                                        </form>

                                                    </div>

                                                <?php } else {

                                                    ?>

                                                    <div class="col-md-6 col-xs-6 col-lg-6">

                                                        <h5 class="text-uppercase"<p>Tu comentario está siendo evaluado.</p></h5>

                                                    </div>

                                                    <?php

                                                }

                                            } else {

                                                ?>

                                                <div class="col-md-6 col-xs-3">

                                                    <h5 class="text-uppercase"><a href="iniciar-sesion">Inicia sesión</a> para escribir una opinión acerca del producto</h5>

                                                </div>

                                            <?php }

                                            ?>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                    <!-- /Product Details -->

                </div>

                <!-- /row -->

            </div>

            <!-- /container -->

        </div>

        <!-- /section -->

        <!-- section -->

        <div class="section">

            <!-- container -->

            <div class="container">

                <!-- row -->

                <div class="row">

                    <!-- section title -->

                    <div class="col-md-12 col-xs-12 col-lg-12">

                        <div class="section-title">

                            <h2 class="title">Productos Relacionados</h2>

                        </div>

                    </div>

                    <!-- section title -->

                    <!-- Product Single -->

                    <?php

                    echo $relacionados;

                    ?>

                </div>

                <!-- /row -->

            </div>

            <!-- /container -->

        </div>

        <!-- /section -->

        <!-- FOOTER -->

        <?php require_once './includes/footer.php'; ?>

        <!-- /FOOTER -->

        <!--jQuery Plugins -->

        <?php require_once './includes/footerScripts.php'; ?>

    </body>

    <script>

        $(".reviews-pages").on('click', 'button', function () {

            var pag = ($(this).attr('id'));

            var id = $('.idProducto').val();

            var data = {};

            data.pag = pag;

            data.product = id;

            $.ajax({

                url: 'ajaxBuscComentarios.php',

                type: 'post',

                data: data,

                success: function (response) {

                   console.log(response);

                    $("#comentarios").html(response.data);

                }

            });

        });

    </script>

    <script>

        function añadirProducto() {

            var cantidad = $('#cantidadProducto').val();

            var accion = 'añadir';

            var idProducto = $('#idProducto').val();

            var objeto = $('#objProducto').val();

            var datos = {'cantidad': cantidad, 'accion': accion, 'idProducto': idProducto, 'objProducto': objeto};

            $.ajax({

                url: 'accion-carrito',

                type: 'post',

                data: datos,

                success: function (response) {

                    var carrito = pintarCarritoHeader(response);

                    $('.shopping-cart-list').html(carrito);

                }

            });

        }

        ;

    </script>





</html>