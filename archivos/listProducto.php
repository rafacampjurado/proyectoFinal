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
$tipo = $_GET['tipo'];
$tipoProducto = $lectura->getProductos($tipo);
$productos = listadoProductos($tipoProducto);
//---------------------------Búsqueda en base de datos de todos los productos que coincidan con el tipo--------------------
//Una vez mostrados los productos se añadirán un botón de detalles que llevará a otra página, desde la cual se mostraran los detalles (BBDD + API)-------
?>
<!DOCTYPE html>
<html lang="en">
    <?php require_once './includes/head.php'; ?>
    <body>
        <!-- HEADER -->
        <?php require_once './includes/header.php'; ?>
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
                    <!-- ASIDE -->

                    <!-- MAIN -->
                    <div id="main" class="col-lg-12 col-md-12 col-xs-12 main">
                        <div class="row" id="listado">
                            <?php echo $productos; ?>
                        </div>
                        <input type="number" hidden="" class="pagina" id="pagina" name="pagina" value="6">
                        <button id="<?php echo $tipo; ?>" class="primary-btn add-to-cart mostrarMas">Mostrar más</button>
                        <!-- /store bottom filter -->
                    </div>
                    <!-- /MAIN -->
                </div>
                <!-- /Product Single -->
            </div>
            <!-- /row -->
            <!--</div>-->
            <!-- /STORE -->
        </div>
        <!-- /MAIN -->
    </div>
    <!-- /row -->
</div>
<!-- /container -->
</div>
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
<script>
    function parsearProductos(productos) {
        var resultado = "";
        productos.forEach(function (producto) {
            var nombre = producto['nombre'];
            var precio = producto['precio'];
            var imagen = producto['imagen'];
            var id = producto['id'];
            resultado += '<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">';
            resultado += '<div class="product product-single">';
            resultado += '<div class="product-thumb">';
            resultado += '<a href="producto/' + id + '"><button class="main-btn quick-view"><i class="fa fa-search-plus"></i> Detalles</button></a>';
            resultado += '<img src="' + imagen + '" alt="">';
            resultado += '</div>';
            resultado += '<div class="product-body">';
            resultado += '<h4 class="product-name"><a href="#">' + nombre + '</a></h4>';
            resultado += '<h4 class="product-price">' + precio + ' €</h4>';
            resultado += '</div></div></div>';
        });
        return resultado;
    }
</script>
<script type="text/javascript">


    $('.mostrarMas').on('click', function () {
        var tipo = ($(this).attr('id'));
        var pag = $('#pagina').val();
        var data = {};
        data.tipo = tipo;
        data.pag = pag;
        $.ajax({
            url: 'ajaxBuscarProductos.php',
            type: 'post',
            data: data,
            success: function (response) {
            	console.log(response);
                if (response != null) {
                    $("#listado").append(parsearProductos(response.data));
                    $("#pagina").val(response.pag);
                } else {
                    $(".mostrarMas").attr('disabled', true);
                    $(".mostrarMas").css('cursor', 'no-drop');
                }
            }
        });
    });


</script>
</html>



