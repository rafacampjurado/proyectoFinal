<?php

include('model/objetoProducto');
require 'acciones/Conexion.php';
require 'acciones/Lectura.php';
$conexion = new Conexion();
$lectura = new Lectura($conexion);
$tipo = $_POST['tipo'];
$limite = $_POST['pag'];
$resultado = $lectura->buscarProductosLimit($tipo, $limite);
$json = [
    "data" => ""];
foreach ($resultado as $value) {

    $nombre = $value['Nombre'];
    $id = $value['idProducto'];
    $tipo = $value['Tipo'];
    $precio = $value['Precio'];
    $imagen = $value['Img'];
    if (isset($nombre)) {
        $res .= <<<EX
<div class="col-md-4 col-sm-6 col-xs-6">
                                    <div class="product product-single">
                                        <div class="product-thumb">
                                            <a href='detalles.php?id=$id'"<button class="main-btn quick-view"><i class="fa fa-search-plus"></i> Detalles</button></a>
                                            <img src="$imagen" alt="">
                                        </div>
                                        <div class="product-body">
                                            <h1 class="product-name"><a href="#">$nombre</a></h1>
                                            <h4 class="product-price">$precio €</h4>
                                        </div>
                                    </div>
                                </div>
                <div class="clearfix visible-sm visible-xs"></div>
EX;
    }
}
$json["data"] = $res;
   $json["pag"] = $limite + 6;

header("Content-Type: application/json");
echo json_encode($json);
