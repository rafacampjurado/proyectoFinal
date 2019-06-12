<?php



require '../../model/comentario.php';

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

        ////////////////////////////////////////////////////////////////////

        $opinion = $_POST['textoComentario'];

        $aprobado = $_POST['aprobacionComentario'];

        $fecha = $_POST['fechaComentario'];

        $idComentario = $_POST['idComentario'];

        $puntuacion = $_POST['puntuacionComentario'];

       $añadir = $controlador->editarComentario($idComentario, $opinion, $fecha, $puntuacion, $aprobado);

    }

    header('Location: ../comentarios/editar/' . $idComentario . '');

} else {

    header('Location: ../../');

}

