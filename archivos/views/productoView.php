<?php







class ProductoView {







    function __construct() {



        



    }







    public static function formNuevoProducto() {



        ?>



        <div class="col-xs-12 col-lg-12 col-lg-12">



            <h1 class="text-center">Añadir nuevo producto</h1>



        </div>



        <div class="col-xs-12 col-lg-12 col-lg-6 col-lg-offset-3 col-xs-offset-0 col-md-offset-0">



            <form method="POST" action="admin/forms-action/añadirProducto.php" enctype="multipart/form-data" >



                <div class="form-group text-left">



                    <labe>Nombre</labe>



                    <input type="text" class="form-control" required="" name="nombreProducto">



                </div>



                <div class="form-group text-left">



                    <labe>Precio</labe>



                    <input type="number" class="form-control" required="" name="precioProducto" min="0.10">



                </div>



                <div class="form-group text-left">



                    <labe>Tipo</labe>



                    <select name="tipoProducto" class="form-control"  required="">



                        <option value="Fruta">Fruta</option>



                        <option value="Hortaliza">Hortaliza</option>



                        <option value="Carne">Carne</option>



                        <option value="Dulce">Dulce</option>



                        <option value="Pescado">Pescado</option>



                        <option value="Aperitivos">Aperitivos</option>



                    </select>



                </div>



                <div class="form-group text-left">



                    <labe>Imagen</labe>



                    <input type="file" class="form-control adminInputFormMaxHeight" name="imagenProducto">



                </div>



                <div class="form-group text-left">



                    <input type="submit" class="form-control btn btn-primary adminInputFormMaxHeight" value="Registrar">



                </div>







            </form>











        </div>



        <?php



    }







    public static function listadoProductos($productos) {



        ?>



        <div class="col-xs-12 col-lg-12 col-lg-12">



            <h1 class="text-center">Listado de productos</h1>



        </div>



        <div class="col-xs-12 col-lg-12 col-lg-12">



            <table class='table table-striped table-hover dt-responsive display nowrap adminDataTableFiltroNombre' id="tablaListadoAdmin">



                <thead>



                    <tr>



                        <th>Img</th>



                        <th>Nombre</th>



                        <th>Precio</th>



                        <th>Tipo</th>



                        <th>Acciones</th>



                        <th colspan="3"></th>



                    </tr>



                </thead>



                <tbody>



                    <?php



                    foreach ($productos as $producto) {



                        $nombre = $producto['Nombre'];



                        $imagen = $producto['Img'];



                        $precio = $producto['Precio'];



                        $tipo = $producto['Tipo'];



                        $idProducto = $producto['idProducto'];







                        $tbody = <<< EX



                            



                         <tr>



                                <th scope="col"><img class="adminImgListadoProductos" src="../$imagen"></th>



                                <th scope="col">$nombre</th>



                                <th scope="col">$precio</th>



                                <th scope="col">$tipo</th>



                                <th scope="col" class="adminAccionesListado">



                                    <a><span class="fa fa-trash adminBotonEliminarListado" data-bind="$idProducto-producto"></span></a>|



                                    <a href="admin/productos/editar/$idProducto"><span class="fa fa-pencil"></span></a>|



                                    <a href="../producto/$idProducto"><span class="fa fa-eye"></span></a>



                               </th>



                        </tr>



EX;



                        echo $tbody;



                    }



                    ?>



                </tbody>



            </table>



        </div>



        <div id="modal-eliminar-producto" class="dialogo ui-widget-content ui-corner-all text-center">



            <form method="POST" action="admin/forms-action/eliminarProducto.php">
                <div class="form-group">



                    <label >¿Quieres eliminar este producto? </label>



                    <input type="number" name="idProducto" value="" id="modalIdEliminar" hidden="">



                </div>



                <button type="submit">Aceptar</button>



            </form>



        </div>



        <?php



    }







    public static function formEditarProducto($producto) {



        ?>



        <div class="col-xs-12 col-lg-12 col-lg-12">



            <h1 class="text-center">Editar producto</h1>



        </div>



        <div class="col-xs-12 col-lg-12 col-lg-6 col-lg-offset-3 col-xs-offset-0 col-md-offset-0">



            <form method="POST" action="admin/forms-action/actualizarProducto.php" enctype="multipart/form-data" >



                <div class="form-group text-left">



                    <labe>Nombre</labe>



                    <input type="text" class="form-control" required="" name="nombreProducto" value="<?php echo $producto->getNombre(); ?>">



                    <input type="number" hidden="" name="idProducto" value="<?php echo $producto->getIdProduct(); ?>">



                </div>



                <div class="form-group text-left">



                    <labe>Precio</labe>



                    <input type="number" class="form-control" required="" name="precioProducto" min="0.10" value="<?php echo $producto->getPrecio(); ?>">



                </div>



                <div class="form-group text-left">



                    <labe>Tipo</labe>



                    <select name="tipoProducto" class="form-control"  required="" >



                        <option value="<?php echo $producto->getTipo(); ?>"><?php echo $producto->getTipo(); ?></option>



                        <option value="Fruta">Fruta</option>



                        <option value="Hortaliza">Hortaliza</option>



                        <option value="Carne">Carne</option>



                        <option value="Dulce">Dulce</option>



                        <option value="Pescado">Pescado</option>



                        <option value="Aperitivos">Aperitivos</option>



                    </select>



                </div>



                <div class="form-group text-left col-lg-6">



                    <labe>Imagen</labe>



                    <input type="file" class="form-control adminInputFormMaxHeight" name="imagenProducto">



                    <input type="text" hidden="" name="imagenActualProducto" value="../<?php echo $producto->getImg(); ?>">



                </div>



                <div class="form-group text-left col-lg-6">



                    <labe>Imagen actual</labe>



                    <img src="../<?php echo $producto->getImg(); ?>" class="adminImgEditarProducto">



                </div>



                <div class="form-group text-left">



                    <input type="submit" class="form-control btn btn-primary adminInputFormMaxHeight" value="Registrar">



                </div>







            </form>











        </div>



        <?php



    }







}



