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

    $idOpinion = $_POST['idOpinion'];

    if ($idOpinion != null) {

        $eliminacion = $escritura->deleteComentarioPorId($idOpinion);

    }

header('Location: ../panel-usuario/comentarios');

} else {

header('Location: /');
}
