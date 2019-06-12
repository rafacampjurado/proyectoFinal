<?php



require '../../controlador/comentariosController.php';

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

        $controlador = new ComentariosController($lectura, $escritura);

        $idComentario = $_POST['idComentario'];

        $eliminar = $controlador->eliminarComentario($idComentario);

    }

    header('Location: ../comentarios');

} else {

     header('Location: ../../');

}

