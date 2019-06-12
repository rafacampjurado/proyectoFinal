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

        $tipo = $_POST['tipoProducto'];

        if ($_FILES['imagenProducto']['tmp_name'] != '') {

            $img = $_FILES['imagenProducto'];

        } else {

            $img ['name'] = 'product01.jpg';

        }
        $añadir = $controlador->añadirNuevoProducto($nombre, $precio, $tipo, $img);

    }

    header('Location: ../productos');

} else {

    header('Location: ../../');

}

