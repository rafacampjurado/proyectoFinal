<?php







require '../acciones/Conexion.php';



require '../model/objetoProducto.php';



require '../controlador/userController.php';



require '../model/usuario.php';



require '../acciones/Lectura.php';



require '../acciones/Escritura.php';



require '../funciones/funciones.php';



$conexion = new Conexion();



$lectura = new Lectura($conexion);



$escritura = new Escritura($conexion);



$controlador = new userController($lectura, $escritura);



session_start();



if (isset($_SESSION['usuario'])) {



   $fecha = date('Y-m-d');



   $idUsuario = $_SESSION['usuario']->getIdUsuario();



   $idDireccion = $_POST['idDireccion'];



   $idTarjeta = $_POST['idTarjetaCredito'];



   $generarPedido = $controlador->generarPedido($idUsuario, $fecha, $idDireccion, $idTarjeta);



   if($generarPedido){



       header('Location: ../checkout/success');



   }



      



} else {



    header('Location: /');



}



