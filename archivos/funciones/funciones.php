<?php

function mostrarOpiniones($opiniones) {
    if (!empty($opiniones)) {
        foreach ($opiniones as $opinion) {
            $nombre = $opinion['usuario'];
            $texto = $opinion['Opinion'];
            $fecha = $opinion['Fecha'];
            $puntuacion = $opinion['Puntuacion'];

            $res .= <<<EX
                <div class="single-review">
    <div class="review-heading">
        <div><a href="#"><i class="fa fa-user"></i> $nombre</a></div>
        <div><a href="#"><i class="fa fa-clock-o"></i> $fecha</a></div>
        <div class="review-rating pull-right">
EX;
            for ($index = 0; $index < $puntuacion; $index++) {
                $res .= '<i class="fa fa-star"></i>';
            }
//            if ((5 - $puntuacion) > 0) {
            for ($index = 0; $index < 5 - $puntuacion; $index++) {
                $res .= '<i class="fa fa-star empty"></i>';
            }
//            }
            $res .= <<<EX
        </div>
        </div>
        <div class="review-body">
        <p>$texto</p>
        </div>
        </div>
EX;
        }
    }
    return $res;
}

function pintarComentariosUsuario($opiniones) {
    if (!empty($opiniones)) {
        $res = <<<EX
               
                <table class='table table-striped table-hover dt-responsive display nowrap' id="tablaComentarios">
                    <thead>
                        <tr>
                           <th>Imagen</th>
                           <th>Nombre</th>
                           <th>Comentario</th>
                           <th>Puntuacion</th>
                           <th>Fecha</th>
                           <th>Acciones</th>
                           <th colspan="2"></th>
                        </tr>
                    </thead>
                    <tbody id="datos">
EX;
        foreach ($opiniones as $opinion) {
            $idOpinon = $opinion['idOpinion'];
            $idProducto = $opinion['idProducto'];
            $imagen = $opinion['img'];
            $nombre = $opinion['Nombre'];
            $texto = $opinion['Opinion'];
            $fecha = $opinion['Fecha'];
            $puntuacion = $opinion['Puntuacion'];
            $pintarPuntuacion = "";
            for ($index = 0; $index < $puntuacion; $index++) {
                $pintarPuntuacion .= '<i class="fa fa-star" arie-hidden="true"></i>';
            }

            for ($index = 0; $index < 5 - $puntuacion; $index++) {
                $pintarPuntuacion .= '<i class="fa fa-star-o" arie-hidden="true"></i>';
            }
            $res .= <<<EX
                        <tr>
                        <th scope="col"><img src='$imagen'></th>
                        <th scope="col" id="campo-nombre" data-bind="$idOpinon"><a href="producto/$idProducto">$nombre </a> </th>
                        <th scope="col" id="campo-texto">$texto</th>
                        <th scope="col" id="campo-puntuacion" data-bind="$puntuacion">$pintarPuntuacion</th>
                        <th scope="col">$fecha</th>
                        <th scope="col">
                            <button class="accion" value="eliminar-comentario-$idOpinon"><i class="fa fa-trash" arie-hidden="true"></i></button>
                            <button class="accion" value="editar-comentario-$idOpinon"><i class="fa fa-info" arie-hidden="true"></i></button>
                       </th>
                        </tr>
                    
EX;
        }
        $res .= '</tbody></table><div class="clear-fix"></div>';
    }

    return $res;
}

function listadoProductos($productos) {
    $resultado = '';
    foreach ($productos as $producto) {
        $nombre = explode('- ', $producto['Nombre'])[0];
        $id = $producto['idProducto'];
        $tipo = $producto['Tipo'];
        $precio = $producto['Precio'];
        $imagen = $producto['Img'];
        $resultado .= <<<EX
<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                    <div class="product product-single">
                                        <div class="product-thumb">
                                            <a href='producto/$id'><button class="main-btn quick-view"><i class="fa fa-search-plus"></i> Detalles</button></a>
                                            <img src="$imagen" alt="">
                                        </div>
                                        <div class="product-body">
                                            <h4 class="product-name"><a href="#">$nombre</a></h4>
                                            <h4 class="product-price">$precio €</h4>
                                        </div>
                                    </div>
                                </div>
                
                
EX;
    }
    return $resultado;
}

function numPaginas($cantidad) {
    $numPaginas;
    while ($cantidad > 0) {
        $cantidad -= 3;
        $numPaginas++;
    }
    return $numPaginas;
}

function pintarPaginas($numOpiniones) {
    $numPaginas = numPaginas($numOpiniones);
    if ($numPaginas > 0) {
        $resultado = '<ul class="reviews-pages">';
        for ($index = 0; $numPaginas > $index; $index++) {
            if ($index == 0) {
                $resultado .= '<li class="pag"><button id="' . ($index) . '" class="numpag primary-btn" data-pagina="' . ($index + 1) . '">' . ($index + 1) . '</button></li>';
            } else {
                $resultado .= '<li class="pag"><button id="' . ($index + 2) . '" class="numpag primary-btn" data-pagina="' . ($index + 1) . '">' . ($index + 1) . '</button></li>';
            }
        }
        $resultado .= '<li><i class="fa fa-caret-right"></i></li>
                </ul>
                <p></p>';
    } else {
        $resultado = "";
    }
    return $resultado;
}

function pintarProductosCarrito() {
    foreach ($_SESSION['usuario']->getCarrito() as $producto) {
        $imagen = $producto->getImg();
        $nombre = $producto->getNombre();
        $precio = $producto->getPrecio();
        $cantidad = $producto->getCantidad();
        $idProducto = $producto->getIdProduct();
        if (!empty($nombre)) {
            $resultado .= <<<EX
        <div class="product product-widget col-xs-12 col-md-12 col-lg-12">
<div class="product-thumb">
 <img src="$imagen" alt="">
 </div>
<div class="product-body">
<h3 class="product-price">$precio €</h3>
<h2 class="product-name"><a href="#">$nombre ($cantidad) </a></h2>
</div>
<a href="./accion-carrito/$idProducto/borrar"<button id="$idProducto" class="cancel-btn"><i class="fa fa-trash"></i></button></a>
</div>
EX;
        }
    }
    return $resultado;
}

function sumaPrecioProductos() {
    $suma = 0.00;
    if (isset($_SESSION['usuario'])) {
        foreach ($_SESSION['usuario']->getCarrito() as $producto) {
            $mult = floatval($producto->getPrecio());
            $suma = $suma + $mult * $producto->getCantidad();
        }
    }
    $total = $suma;
    return $total;
}

function pintarListaCarrito() {
    $resultado;
    foreach ($_SESSION['usuario']->getCarrito() as $producto) {
        $imagen = $producto->getImg();
        $nombre = $producto->getNombre();
        $precio = $producto->getPrecio();
        $cantidad = $producto->getCantidad();
        $idProducto = $producto->getIdProduct();
        $tipo = $producto->getTipo();
        if ($nombre != "") {
            $resultado .= <<<EX
                    <tbody class="tbody-elementos">
                    <tr>
                    <th scope="col"><img src="$imagen" style="width:10%;"></th>
                    <th scope="col" id="idProducto" data-bind="$idProducto">$nombre</th>
                    <th scope="col" id="precioProducto"><a id="precio" data-bind="$precio">$precio</a>€</th>
                    <th scope="col">$tipo</th>
                    <th scope="col" >
                    <a class="fa fa-arrow-up incrementar spanClick" ></a>
                        x <span id="cantidadProducto">$cantidad</span>
                    <a class="fa fa-arrow-down disminuir spanClick"></a>
                    </th>
                    <th scope="col"><a class="fa fa-trash borrarProducto spanClick"></a></th>
                    </tr>
                    </tbody>
EX;
        }
    }
    $sumaTotal = sumaPrecioProductos();
    $resultado .= '<tr><th></th><th></th><th></th></th><th>Suma total:</th><th><span id="sumaTotal">' . $sumaTotal . '</span> €</th><th><a href="accion-carrito/borrarTodo"<button class="cancel-btn"><i class="fa fa-trash"></i></button></a></th></tr>';
    $resultado .= '<tr><th></th><th></th><th></th><th></th><th></th><th></th></tr></tbody>';
    return $resultado;
}

function procesarArrayFacturas($facturas) {
    $arrayFacturas;
    $ultimoID = $facturas[0]['id'];
    $contador = 0;
    $contadorCabecera = 0;
    foreach ($facturas as $factura) {
        if ($factura['id'] != $ultimoID) {
            $ultimoID = $factura['id'];
            $contadorCabecera++;
        }
        foreach ($facturas as $factura) {

            if ($factura['id'] == $ultimoID) {
                $arrayFacturas[$contadorCabecera][$contador] = [
                    'id' => $factura['id'],
                    'nombre' => $factura['nombre'],
                    'fecha' => $factura['fecha'],
                    'imagen' => $factura['imagen'],
                    'tipo' => $factura['tipo'],
                    'cantidad' => $factura['cantidad'],
                    'precio' => $factura['precio'],
                    'direccion' => $factura['direccion'],
                    'tarjeta' => $factura['tarjeta']
                ];
                $contador++;
            }
        }
        $contador = 0;
    }
    return $arrayFacturas;
}

function pintarFacturas($facturas) {
    $facturas = procesarArrayFacturas($facturas);

    foreach ($facturas as $factura) {
        $sumaTotal = 0;
        for ($index = 0; $index < count($facturas); $index++) {
            if (!empty($factura[$index])) {
                if ($index == 0) {
                    $tablas .= "<pre><table class='table'><tr>"
                            . "<th scope='col'>ID de la factura : " . $factura[$index]['id'] . "</th>"
                            . "<th scope='col'>Fecha: " . $factura[$index]['fecha'] . "</th>"
                            . "<th scope='col'>Envío: " . $factura[$index]['direccion'] . "</th>"
                            . "<th scope='col'>Pago: " . $factura[$index]['tarjeta'] . "</th>"
                            . "</tr>"
                            . "<tr>"
                            . "<th scope='col'>Imagen</th>"
                            . "<th scope='col'>Nombre</th>"
                            . "<th scope='col'>Tipo</th>"
                            . "<th scope='col'>Precio</th>"
                            . "<th scope='col'>Cantidad</th>";
                }
                $tablas .= "<tr><th scope='col'><img src='" . $factura[$index]['imagen'] . "' style='width:10%'></th>"
                        . "<th scope='col'>" . $factura[$index]['nombre'] . "</th>"
                        . "<th scope='col'>" . $factura[$index]['tipo'] . "</th>"
                        . "<th scope='col'>" . $factura[$index]['precio'] . "</th>"
                        . "<th scope='col'>" . $factura[$index]['cantidad'] . "</th>"
                        . "</tr>";
                $sumaTotal = (float) $sumaTotal + (float) $factura[$index]['precio'] * $factura[$index]['cantidad'];
            }
        }
        $tablas .= "<tr><th></th><th></th><th></th><th scope='col'>Suma total = $sumaTotal € </th><th scope='col'></th></tr>";
        $tablas .= "</table></pre>";
    }
    return $tablas;
}

function productosRelacionados($productos) {
    foreach ($productos as $producto) {
        $idProducto = $producto['idProducto'];
        $nombre = substr($producto['nombre'], 0, 15);
        $precio = $producto['precio'];
        $imagen = $producto['img'];
        $cadena .= <<<EX
                    <div class="col-md-3 col-sm-3 col-xs-6 col-lg-3">
                            <div class="product product-single">
                                <div class="product-thumb">
                                    <a href="producto/$idProducto"><button class="main-btn quick-view"><i class="fa fa-info"></i> Detalles</button></a>
                                    <img src="$imagen" alt="">
                                </div>
                                <div class="product-body">
                                    <h3 class="product-price">$precio €</h3> 
                                    <div class="product-rating">
                                    </div>
                                    <h2 class="product-name"><a href="producto/$idProducto">$nombre</a></h2>
                                    <div class="product-btns center">
                                        <a href="producto/$idProducto"><button class="main-btn icon-btn"><i class="fa fa-info"></i></button> <Strong>Información</Strong></a>
                                    </div>
                                </div>
                            </div>
                        </div>
EX;
    }
    return $cadena;
}

function ultimosProductosVendidos($productos) {
    $cadenaTexto = "";
    foreach ($productos as $producto) {
        $idProducto = $producto['idProducto'];
        $nombre = $producto['Nombre'];
        $precio = $producto['precio'];
        $imagen = $producto['img'];
        $cadenaTexto .= <<<EX
                    <div class="product product-single">
                                    <div class="product-thumb text-center">
                                        <a href="producto/$idProducto"<button class="main-btn quick-view"><i class="fa fa-search-plus"></i> Más información</button></a>
                                        <img src="$imagen" alt="">
                                    </div>
                                    <div class="product-body">
                                        <h3 class="product-price">$precio €</h3>
                                        <h2 class="product-name"><a href="producto/$idProducto">$nombre</a></h2>
                                    </div>
                                </div>
EX;
    }
    return $cadenaTexto;
}

function buscarApi($nombre) {
    $apiKey = "252cc403756b3da734c595016b67a914";
    $comidaSTR = explode(" - ", $nombre);
    $food = $comidaSTR[0];
    $url = "https://www.food2fork.com/api/search?key=$apiKey&q=$food&page=1";
    $response = (!empty($url)) ?file_get_contents($url) : false;
    $resultado = (!empty($response)) ? json_decode($response, true) : false;
    $res = "";

    for ($index = 0; $index < $resultado['count']; $index++) {
        $titulo = substr($resultado['recipes'][$index]['title'], 0, 25);
        $id = $resultado['recipes'][$index]['recipe_id'];
        $imagen = $resultado['recipes'][$index]['image_url'];
        $url = $resultado['recipes'][$index]['source_url'];
        $res .= <<<EX
<div class="col-md-4  col-xs-6 col-lg-3 productoReceta">
                                    <div class="product product-single">
                                        <div class="product-thumb">
                                            <a href='$url'"<button class="main-btn quick-view"><i class="fa fa-search-plus"></i> Detalles</button></a>
                                            <img src="$imagen" alt="">
                                        </div>
                                        <div class="product-body">
                                            <h1 class="product-name"><a href="#">$titulo</a></h1>
                                        </div>
                                    </div>
                                </div>
                
                
EX;
    }
    if ($res == "") {
        $res = "No se han encontrado recetas para ese alimento";
    }
    return $res;
}
