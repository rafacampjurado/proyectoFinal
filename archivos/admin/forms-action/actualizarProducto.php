<?php



require '../../model/objetoProducto.php';

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

        $controlador = new productoController($lectura, $escritura);

        $nombre = $_POST['nombreProducto'];

        $precio = $_POST['precioProducto'];

        $idProducto = $_POST['idProducto'];

        $tipo = $_POST['tipoProducto'];

        if ($_FILES['imagenProducto']['tmp_name'] != '') {

            $img = $_FILES['imagenProducto'];

        } else {

            $img['name'] = $_POST['imagenActualProducto'];

        }
        $añadir = $controlador->actualizarProducto($nombre, $tipo, $precio, $img, $idProducto);

    }

    header('Location: ../productos/editar/'.$idProducto.'');

} else {

    header('Location: ../../');

}

