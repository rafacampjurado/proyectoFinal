<?php







require '../acciones/Conexion.php';



require '../acciones/Lectura.php';



require '../acciones/Escritura.php';



require '../controlador/userController.php';



require '../model/usuario.php';



require '../funciones/funciones.php';



session_start();



$conexion = new Conexion();



$lectura = new Lectura($conexion); // Si no existe la sesión se crea una



$escritura = new Escritura($conexion);



$controlador = new userController($lectura, $escritura);



if (!isset($_SESSION['usuario'])) { //LOGIN O LOGOUT



    $usuario = $_POST['usuario'];



    $password = md5($_POST['contraseña']);



    $recordarUsuario = (isset($_POST['recordarUsuario'])) ? $_POST['recordarUsuario'] : false ;



    $cookieNameUser = $_COOKIE['recordarUsuario'];



    if ($recordarUsuario) {



        if ($usuario != $cookieNameUser) {



            setcookie('recordarUsuario', $usuario, time() - 1, '/');



            setcookie('recordarUsuario', $usuario, time() + 60 * 60 * 24 * 30, '/');



        }



    } else {



        setcookie('recordarUsuario', $usuario, time() - 1, '/');



    }







    $loogear = $controlador->loginUsuario($usuario, $password);



    if ($loogear) {



        header("Location: ../");



    } else {



        header("Location: ../iniciar-sesion/error");



    }



} else { // si existe una sesión se cierra



    $logout = $controlador->logout();



    header("Location: ../");



}











