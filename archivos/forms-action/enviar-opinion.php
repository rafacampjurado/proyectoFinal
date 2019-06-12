<?php
include '../acciones/Conexion.php';

include '../acciones/Escritura.php';

include '../model/usuario.php';
session_start();
include '../funciones/funciones.php';

if (isset($_SESSION['usuario'])) {

    $conexion = new Conexion();

    $escritura = new Escritura($conexion);

    $idUsuario = $_SESSION['usuario']->getIdUsuario();

    $opinion = $_POST['opinion'];

    $rating = $_POST['rating'];

    $fecha = date('Y-m-d');

    if ($rating == "") {

        $rating = 0;

    } $idProducto = $_POST['idProducto'];

    $consulta = $escritura->añadirComentario($idUsuario, $idProducto, $opinion, $rating, $fecha);

    if ($consulta != 1) {

        header('Location: ../producto/' . $idProducto . '/error');

    }

    header('Location: ../producto/' . $idProducto);

} else {

    header('Location: ../');

}