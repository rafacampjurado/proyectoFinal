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

    $numeroTarjeta = $_POST['numTarjeta'];

    $marcaTarjeta = $_POST['marcaTarjeta'];

    $idUsuario = $_SESSION['usuario']->getIdUsuario();

    $añadir = $escritura->añadirNuevaTarjeta($numeroTarjeta, $marcaTarjeta, $idUsuario);
    header('Location: ../panel-usuario/metodos-de-pago');

} else {

header('Location: /');
}
