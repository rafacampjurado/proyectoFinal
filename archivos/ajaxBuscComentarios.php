<?phpinclude('model/objetoProducto.php');require 'acciones/Conexion.php';require 'acciones/Lectura.php';$conexion = new Conexion();$lectura = new Lectura($conexion);$idProducto = $_POST['product'];$limite = $_POST['pag'];$resultado = $lectura->buscarComentarios($limite, $idProducto);$json = [    "data" => ""];$res = "";foreach ($resultado as $value) {    $nombre = $value['usuario'];    $opinion = $value['Opinion'];    $fecha = $value['Fecha'];    $puntuacion = $value['Puntuacion'];    $res .= <<<EX                <div class="single-review">                <div class="review-heading">                <div><a href="#"><i class="fa fa-user"></i> $nombre</a></div>                <div><a href="#"><i class="fa fa-clock-o"></i> $fecha</a></div>                <div class="review-rating pull-right">EX;    for ($index = 0; $index < $puntuacion; $index++) {        $res .= '<i class="fa fa-star"></i>';    }    if (5 - $puntuacion > 0) {        for ($index = 0; $index < 5 - $puntuacion; $index++) {            $res .= '<i class="fa fa-star-o empty"></i>';        }    }    $res .= <<<EX        </div>        </div>        <div class="review-body">        <p>$opinion</p>        </div>        </div>EX;    $json["data"] = $res;}header("Content-Type: application/json");echo json_encode($json);