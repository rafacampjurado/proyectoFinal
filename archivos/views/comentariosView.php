<?php







class ComentariosView {







    function __construct() {



        



    }







    public static function listarComentarios($comentarios) {



        ?>



        <div class="col-xs-12 col-lg-12 col-lg-12">



            <h1 class="text-center">Listado de comentarios</h1>



        </div>



        <div class="col-xs-12 col-lg-12 col-lg-12">



            <table class='table table-striped table-hover dt-responsive display nowrap adminDataTableFiltroFecha' id="tablaListadoAdmin">



                <thead>



                    <tr>



                        <th>Imagen</th>



                        <th>Producto</th>



                        <th>Autor</th>



                        <th>Comentario</th>



                        <th>Puntuacion</th>



                        <th>Fecha</th>



                        <th>Aprobación</th>



                        <th>Acciones</th>



                        <th colspan="2"></th>



                    </tr>



                </thead>



                <tbody>



                    <?php



                    foreach ($comentarios as $comentario) {



                        $idOpinion = $comentario['idOpinion'];

                        $idProducto = $comentario['idProducto'];



                        $usuario = $comentario['usuario'];



                        $producto = $comentario['producto'];



                        $opinion = $comentario['Opinion'];



                        $fecha = $comentario['Fecha'];



                        $puntuacion = $comentario['Puntuacion'];



                        $aprobado = ($comentario['Aprobado']) ? 'Si' : 'No';



                        $imagenProducto = $comentario['Img'];







                        $tbody = <<< EX



                            



                         <tr>



                                <th scope="col"><img class="adminImgListadoProductosComentarios" src="../$imagenProducto"></th>



                                <th scope="col"><a href="../producto/$idProducto">$producto</a></th>



                                <th scope="col">$usuario</th>



                                <th scope="col">$opinion</th>



                                <th scope="col">$puntuacion</th>



                                <th scope="col">$fecha</th>



                                <th scope="col">



                                        <select name="aprobacionComentario" data-bind="$idOpinion" id="campoAprobacion">



                                            <option value="$aprobado">Actual: $aprobado</option>



                                            <option value="1">Si</option>



                                            <option value="0">No</option>



                                        </select>



                                </th>



                                <th scope="col" class="adminAccionesListado">



                                    <a><span class="fa fa-trash adminBotonEliminarListado" data-bind="$idOpinion-comentario"></span></a> |



                                    <a href="admin/comentarios/editar/$idOpinion"><span class="fa fa-pencil"></span></a>



                               </th>



                        </tr>



EX;



                        echo $tbody;



                    }



                    ?>



                </tbody>



            </table>



        </div>



        <div id="modal-eliminar-comentario" class="dialogo ui-widget-content ui-corner-all text-center">



            <form method="POST" action="admin/forms-action/eliminarComentario.php">



                <div class="form-group">



                    <label >¿Quieres eliminar este comentario? </label>



                    <input type="number" name="idComentario" value="" id="modalIdEliminar" hidden="">



                </div>



                <button type="submit">Aceptar</button>



            </form>



        </div>



        <?php



    }



        public static function formEditarComentario($comentario) {



        



        ?>



        <div class="col-xs-12 col-lg-12 col-lg-12">



            <h1 class="text-center">Editar comentario</h1>



        </div>



        <div class="col-xs-12 col-lg-12 col-lg-6 col-lg-offset-3 col-xs-offset-0 col-md-offset-0">



            <form method="POST" action="admin/forms-action/actualizarComentario.php" enctype="multipart/form-data" id="formAdminEditarUsuario" >



                <div class="form-group text-left">



                    <labe>Opinión</labe>



                    <input type="text" class="form-control" required="" name="textoComentario" value="<?php echo $comentario->getOpinion(); ?>">



                    <input type="text"  hidden="" name="idComentario" value="<?php echo $comentario->getIdOpinion(); ?>">



                </div>



                <div class="form-group text-left">



                    <labe>Aprobación</labe>



                    <select name="aprobacionComentario" required class="form-control">



                        <option selected="" value="<?php echo $comentario->getAprobado(); ?>">Actual: <?php echo ($comentario->getAprobado() == 1) ? 'Si' : 'No' ?></option>



                        <option value="1">Si</option>



                        <option value="0">No</option>



                    </select>



                </div>



                <div class="form-group text-left">



                    <labe>Fecha</labe>



                    <input type="date"  class="form-control" required name="fechaComentario"value="<?php echo $comentario->getFecha() ?>">



                </div>



                <div class="form-group text-left">



                    <labe>Puntuacion</labe>



                    <input type="number" class="form-control" name="puntuacionComentario" min="1" max="5" value="<?php echo $comentario->getPuntuacion(); ?>">



                </div>







                <div class="form-group text-left">



                    <input type="submit" class="form-control btn btn-primary adminInputFormMaxHeight" value="Actualizar">



                </div>







            </form>



        </div>



        <?php



    }







}



