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
        $idProducto = $_POST['idProducto'];
        $eliminar = $controlador->eliminarPost($idProducto);
    }
    header('Location: ../productos.php?listar');
} else {
    header('Location: ../index.php');
}
