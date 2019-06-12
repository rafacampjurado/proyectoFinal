<?php



require '../acciones/Conexion.php';

require '../acciones/Lectura.php';

require '../acciones/Escritura.php';

require '../funciones/funciones.php';

require '../model/usuario.php';

$conexion = new Conexion();

$lectura = new Lectura($conexion);

$escritura = new Escritura($conexion);

session_start();

if (isset($_SESSION['usuario'])) {

    $calle = $_POST['calle'];

    $codigoPostal = $_POST['codigoPostal'];

    $telefono = $_POST['telefono'];

    $ciudad = $_POST['ciudad'];

    $pais = $_POST['pais'];

    $idUsuario = $_SESSION['usuario']->getIdUsuario();

    $alias = $_POST['alias'];



    $añadir = $escritura->añadirDireccionUsuario($alias, $calle, $codigoPostal, $telefono, $ciudad, $pais, $idUsuario);

}

header('Location: ../panel-usuario/metodos-de-pago');