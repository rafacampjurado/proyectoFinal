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
     $idTarjeta = $_POST['idTarjeta'];
     if($idTarjeta != null){
         $idUsuario = $_SESSION['usuario']->getIdUsuario();
         $eliminar = $escritura->deleteTarjetaUsuario($idTarjeta, $idUsuario);
     }
}
header('Location: ../panel-usuario/metodos-de-pago');
