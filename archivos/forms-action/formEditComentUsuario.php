<?php

require '../acciones/Conexion.php';

require '../acciones/Lectura.php';

require '../acciones/Escritura.php';

require '../funciones/funciones.php';

$conexion = new Conexion();

$lectura = new Lectura($conexion);

$escritura = new Escritura($conexion);

session_start();

if (isset($_SESSION['usuario'])) {



    $comentario = $_POST['comentarioProducto'];

    $puntuacion = $_POST['puntuacionProducto'];

    $idOpinion = $_POST['idOpinion'];

    $opinionEnDB = $lectura->getOpinionPorIdOpinion($idOpinion)[0];

    if (($comentario != $opinionEnDB['Opinion']) || ($puntuacion != $opinionEnDB['Puntuacion'])) {

        $actualizacion = $escritura->updateComentarioPorID($idOpinion, $puntuacion, $comentario);

    }
    header('Location: ../panel-usuario/comentarios');

} else {
	header('Location: /');
}



