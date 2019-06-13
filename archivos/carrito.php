<?php



include('funciones/funciones.php');

require_once 'model/objetoProducto.php';

require_once 'model/usuario.php';

session_start();
if (isset($_SESSION['usuario']) && isset($_POST['accion'])) {
$accion = (isset($_POST['accion'])) ? $_POST['accion'] : $_GET['accion'];

$idProducto = (isset($_GET['id'])) ? $_GET['id'] : false;

$cantidad = (isset($_POST['cantidad'])) ? $_POST['cantidad'] : false;

$longitudCarrito = count($_SESSION['usuario']->getCarrito());

$objDeserializado = (isset($_POST['objProducto'])) ? unserialize($_POST['objProducto']) : false;

if ($objDeserializado) {

    $objDeserializado->setCantidad($cantidad);

}

    switch ($accion) {

        case 'añadir':

            ///////////Comprobamos si el producto existe en la SESIÓN

            $existeProducto = false;

            foreach ($_SESSION['usuario']->getCarrito() as $index => $objetoCarrito) {

                if ($objetoCarrito->getIdProduct() === $objDeserializado->getIdProduct()) {

                    $_SESSION['usuario']->getCarrito()[$index]->setCantidad($_SESSION['usuario']->getCarrito()[$index]->getCantidad() + $cantidad);

                    $existeProducto = true;

                }

            }

            if (empty($_SESSION['usuario']->getCarrito()) || !$existeProducto) {

                $_SESSION['usuario']->añadirNuevoProducto($objDeserializado);

            }



            echo json_encode((array) $_SESSION['usuario']->getCarrito());

            break;

        case 'borrarTodo':

            $_SESSION['usuario']->eliminarTodosLosProductos();

             header('Location: ' . $_SERVER['HTTP_REFERER']);

            break;

        case 'borrar':

            foreach ($_SESSION['usuario']->getCarrito() as $index => $objetoCarrito) {

                if ($objetoCarrito->getIdProduct() === $idProducto) {

                    $_SESSION['usuario']->eliminarProducto($index);

                }

            }

            header('Location: ' . $_SERVER['HTTP_REFERER']);

            break;



        default:

            break;

    }

} else {

    header("location: /");

}