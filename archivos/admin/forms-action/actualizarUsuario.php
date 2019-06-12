<?php



require '../../model/objetoProducto.php';

require '../../controlador/userController.php';

require '../../model/usuario.php';

require '../../acciones/Conexion.php';

require '../../acciones/Lectura.php';

require '../../acciones/Escritura.php';

require '../../funciones/funciones.php';

session_start();



if (isset($_SESSION['usuario'])) {

    if ($_SESSION['usuario']->getRol() == 'admin') {

        $conexion = new Conexion();

        $lectura = new Lectura($conexion);

        $escritura = new Escritura($conexion);

        $controlador = new userController($lectura, $escritura);

        /////////////////////////////////////////////////////////////////////////

        $usuario = $_POST['nombreUsuario'];

        $idUsuario = $_POST['idUsuario'];

        $email = $_POST['emailUsuario'];

        $rol = $_POST['rolUsuario'];

        $fecha = $_POST['fechaUsuario'];

        if ($_FILES['imagenUsuario']['tmp_name'] != '') {

            $img = $_FILES['imagenUsuario'];

        } else {

            $img ['name'] = $_POST['imagenActualUsuario'];

        }

        $añadir = $controlador->actualizarUsuario($usuario, $email, $rol, $fecha, $img, $idUsuario);

    }

    header('Location: ../usuarios/editar/'.$idUsuario);

} else {

    header('Location: ../../');

}

