<?php



require 'model/objetoProducto.php';

require 'controlador/productoController.php';

require 'controlador/userController.php';

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

if (isset($_SESSION['usuario'])) {

    $idProducto = $_POST['idProducto'];

    $accion = $_POST['accion'];



    foreach ($_SESSION['usuario']->getCarrito() as $index => $productoCarrito) {



        if ($productoCarrito->getIdProduct() === $idProducto) {

            if ($accion == 'incrementar' || $accion == 'disminuir') {

                if ($accion == 'incrementar') {

                    $_SESSION['usuario']->getCarrito()[$index]->setCantidad( $_SESSION['usuario']->getCarrito()[$index]->getCantidad() + 1);

                } else {

                    if ($_SESSION['usuario']->getCarrito()->getCantidad() - 1 >= 1) {

                        $_SESSION['usuario']->getCarrito()->setCantidad( $_SESSION['usuario']->getCarrito()[$index]->getCantidad() - 1);

                    }

                }

            } else {

                $_SESSION['usuario']->eliminarProducto($index);

            }

        }

    }

    echo json_encode((array) $_SESSION['usuario']->getCarrito());

} else {

    header('Location: /');

}    