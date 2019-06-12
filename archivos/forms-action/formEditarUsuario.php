<?php



require '../acciones/Conexion.php';

require '../acciones/Lectura.php';

require '../acciones/Escritura.php';

require '../controlador/userController.php';

require '../funciones/funciones.php';

require '../model/usuario.php';





session_start();

if (isset($_SESSION['usuario'])) {

    $conexion = new Conexion();

    $escritura = new Escritura($conexion);

    $lectura = new Lectura($conexion);

    $controlador = new userController($lectura, $escritura);

    /////////////////////////////////////////////////////////////////////////

    $imagen = (isset($_FILES['imagenUsuario'])) ? $_FILES['imagenUsuario'] : false;

    $nombre = (isset($_POST['nombreUsuario'])) ? $_POST['nombreUsuario'] : false;

    $apellidos = (isset($_POST['apellidosUsuario'])) ? $_POST['apellidosUsuario'] : false;

    /////////////////////////////////////////////////////////////////////////

    $idUsuario = $_SESSION['usuario']->getIdUsuario();

    $editar = $controlador->editarUsuario($nombre, $idUsuario, $imagen, $apellidos);

    

}

header('Location: ../panel-usuario');

