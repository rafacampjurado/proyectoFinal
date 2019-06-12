<?php

require 'model/objetoProducto.php';
require 'acciones/Conexion.php';
require 'acciones/Lectura.php';
$conexion = new Conexion();
$lectura = new Lectura($conexion);
$tipo = $_POST['tipo'];
$limite = $_POST['pag'];
$resultado = $lectura->buscarProductosLimit($tipo, $limite);
$json = ["data" => "", 'pag' => ""];
if (!empty($resultado)) {
    foreach ($resultado as $value) {

        $nombre = explode('-', $value['Nombre'])[0];
        $id = $value['idProducto'];
        $tipo = $value['Tipo'];
        $precio = $value['Precio'];
        $imagen = $value['Img'];
        $res [] = [
            'nombre' => $nombre,
            'id' => $id,
            'tipo' => $tipo,
            'precio' => $precio,
            'imagen' => $imagen];
        $json["data"] = $res;
    }
    
    $json["pag"] = $limite + 6;
} else {
    $json = null;
}


header("Content-Type: application/json");
echo json_encode($json);
