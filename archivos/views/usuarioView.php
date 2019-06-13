<?php







class UsuarioView {







    function __construct() {



        



    }







    public static function listadoUsuarios($usuarios) {



        ?>



        <div class="col-xs-12 col-lg-12 col-lg-12">



            <h1 class="text-center">Listado de usuarios</h1>



        </div>



        <div class="col-xs-12 col-lg-12 col-lg-12">



            <table class='table table-striped table-hover dt-responsive display nowrap adminDataTableFiltroNombre' id="tablaListadoAdmin">



                <thead>



                    <tr>



                        <th>Imagen</th>



                        <th>Usuario</th>



                        <th>Rol</th>



                        <th>Email</th>



                        <th>Nombre</th>



                        <th>Apellidos</th>



                        <th>Acciones</th>



                        <th colspan="2"></th>



                    </tr>



                </thead>



                <tbody>



                    <?php



                    foreach ($usuarios as $usuario) {



                        $nombre = $usuario['nombre'];



                        $apellidos = $usuario['apellidos'];



                        $imagen = $usuario['imagen'];



                        $rol = $usuario['rol'];



                        $email = $usuario['email'];



                        $idUsuario = $usuario['idUsuario'];



                        $nameUsuario = $usuario['usuario'];



                        $rutaImagen = ($imagen == 'default.png') ? './img/user-images/' . $imagen : './img/user-images/' . $idUsuario . '-' . $imagen;







                        $tbody = <<< EX



                            



                         <tr>



                                <th scope="col"><img class="adminImgUsuariosListado" src="$rutaImagen"></th>



                                <th scope="col">$nameUsuario</th>



                                <th scope="col">$rol</th>



                                <th scope="col">$email</th>



                                <th scope="col">$nombre</th>



                                <th scope="col">$apellidos</th>



                                <th scope="col" class="adminAccionesListado">



                                    <a><span class="fa fa-trash adminBotonEliminarListado" data-bind="$idUsuario-usuario"></span></a>|



                                    <a href="admin/usuarios/editar/$idUsuario"><span class="fa fa-pencil"></span></a>



                               </th>



                        </tr>



EX;



                        echo $tbody;



                    }



                    ?>



                </tbody>



            </table>



        </div>



        <div id="modal-eliminar-usuario" class="dialogo ui-widget-content ui-corner-all text-center">



            <form method="POST" action="admin/forms-action/eliminarUsuario.php">



                <div class="form-group">



                    <label >¿Quieres eliminar este usuario? </label>



                    <input type="number" name="idUsuario" value="" id="modalIdEliminar" hidden="">



                </div>



                <button type="submit">Aceptar</button>



            </form>



        </div>



        <?php



    }







    public static function formEditarUsuario($usuario) {



        $imagen = ($usuario->getImagen() == 'default.png') ? './img/user-images/' . $usuario->getImagen() : './img/user-images/' . $usuario->getIdUsuario() . '-' . $usuario->getImagen();



        ?>



        <div class="col-xs-12 col-lg-12 col-lg-12">



            <h1 class="text-center">Editar usuario</h1>



        </div>



        <div class="col-xs-12 col-lg-12 col-lg-6 col-lg-offset-3 col-xs-offset-0 col-md-offset-0">



            <form method="POST" action="admin/forms-action/actualizarUsuario.php" enctype="multipart/form-data" id="formAdminEditarUsuario" >



                <div class="form-group text-left">



                    <labe>Nombre de Usuario</labe>



                    <input type="text" class="form-control" required="" name="nombreUsuario" value="<?php echo $usuario->getUsuario(); ?>">



                    <input type="number" hidden="" name="idUsuario" value="<?php echo $usuario->getIdUsuario(); ?>">



                </div>



                <div class="form-group text-left">



                    <labe>Email</labe>



                    <input type="email" class="form-control" required="" name="emailUsuario" value="<?php echo $usuario->getEmail(); ?>">



                </div>



                <div class="form-group text-left">



                    <labe>Rol</labe>



                    <select name="rolUsuario" required class="form-control">



                        <option selected="" value="<?php echo $usuario->getRol(); ?>">Actual: <?php echo $usuario->getRol(); ?></option>



                        <option value="admin">Admin</option>



                        <option value="usuario">Usuario</option>



                    </select>



                </div>



                <div class="form-group text-left">



                    <labe>Fecha</labe>



                    <input type="date"  class="form-control" required name="fechaUsuario"value="<?php echo $usuario->getFecha() ?>">



                </div>



                <div class="form-group text-left col-lg-6">



                    <labe>Imagen</labe>



                    <input type="file" class="form-control adminInputFormMaxHeight" name="imagenUsuario">



                    <input type="text" hidden="" name="imagenActualUsuario" value="<?php echo $usuario->getImagen(); ?>">



                </div>



                <div class="form-group text-left col-lg-6">



                    <labe>Imagen actual</labe>



                    <img src="<?php echo $imagen ?>" class="adminImgEditarProducto">



                </div>







                <div class="form-group text-left">



                    <input type="submit" class="form-control btn btn-primary adminInputFormMaxHeight" value="Actualizar">



                </div>







            </form>



        </div>



        <?php



    }







}



