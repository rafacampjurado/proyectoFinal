<?php







require '../acciones/Conexion.php';



require '../acciones/Lectura.php';



require '../acciones/Escritura.php';



require '../controlador/userController.php';



require '../funciones/funciones.php';











session_start();



if (!isset($_SESSION['usuario'])) {



    $conexion = new Conexion();



    $escritura = new Escritura($conexion);



    $lectura = new Lectura($conexion);



    $controlador = new userController($lectura, $escritura);







    $usuario = $_POST['usuario'];



    $email = $_POST['email'];



    $password = md5($_POST['contraseña']);



    $nombre = $_POST['nombre'];



    $apellidos = $_POST['apellidos'];



    $imagen =  ($_FILES['imagenPerfil']['tmp_name'] != '') ? $_FILES['imagenPerfil'] : false;

    if(!$imagen){

        $imagen['name'] = "default.png";

    }



    $fecha = date('Y-m-d');

    $nuevoUsuario = $controlador->registrarUsuario($nombre, $apellidos, $email, $usuario, $password, $fecha, $imagen);



    if ($nuevoUsuario == 1) {



        header("location: ../registro/sucess");



    } else {



        header("location: ../registro/error");



    }



} else {



    header('Location: /');



}



