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
    $idDireccion = $_POST['idDireccion'];
    if ($idDireccion != null) {
        $idUsuario = $_SESSION['usuario']->getIdUsuario();
        $eliminacion = $escritura->deleteDireccionUsuario($idDireccion, $idUsuario);
    }
}
header('Location: ../panel-usuario/metodos-de-pago');
