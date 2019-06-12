<?php



require '../../controlador/productoController.php';

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

        $idUsuario = $_POST['idUsuario'];

        $eliminar = $controlador->eliminarUsuario($idUsuario);

    }

    header('Location: ../usuarios');

} else {

    header('Location: ../../');

}

