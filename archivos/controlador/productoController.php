<?php



class productoController {



    private $consultar;

    private $escribir;



    function __construct(Lectura $consultar, Escritura $escribir) {

        $this->consultar = $consultar;

        $this->escribir = $escribir;

    }



    function getConsultar() {

        return $this->consultar;

    }



    function getEscribir() {

        return $this->escribir;

    }



    function crearProducto($producto) {

        return new objtProducto($producto['idProducto'], $producto['nombre'], $producto['precio'], $producto['tipo'], $producto['img']);

    }



    function buscarProducto($idProducto) {

        $producto = $this->getConsultar()->getSingleProduct($idProducto)[0];

        return $this->crearProducto($producto);

    }



    function getCountOpinionesProducto($idProducto) {

        return $this->getConsultar()->getCountOpinionesProducto($idProducto);

    }



    function getProductosRelacionados($tipo) {

        return $this->getConsultar()->getProductosRelacionados($tipo);

    }



    //////////////////////////////////////////////////////////////////////////////

    public function guardarImagen($imagen, $ruta) {

        $nombreFichero = str_replace(' ', '', $imagen['name']);

        $nombreTemporal = (isset($imagen['tmp_name'])) ? $imagen['tmp_name'] : false;

        $destino = $ruta. $nombreFichero;

        if ($nombreTemporal) {

            return move_uploaded_file($nombreTemporal, $destino);

        } else {

            return false;

        }

    }



    public function nuevoProducto() {

        return ProductoView::formNuevoProducto();

    }



    function añadirNuevoProducto($nombre, $precio, $tipo, $img) {

        $imgName = str_replace(' ', '', $img['name']);

        $guardar = $this->getEscribir()->añadirNuevoProducto($nombre, $precio, $tipo, "img/".$imgName);

        if($guardar && $img['name'] != 'product01.jpg'){

            $this->guardarImagen($img, "../../img/");

            return true;

        } else {

            return false;

        }

    }

    

    public function listadoProductos(){

        $productos = $this->getConsultar()->getAllProducts();

        return ProductoView::listadoProductos($productos);

    }

    

    public function editarProducto($idProducto){

        $producto = $this->buscarProducto($idProducto);

        return ProductoView::formEditarProducto($producto);

    }

    function actualizarProducto($nombre, $tipo, $precio, $img, $idProducto){
        if($img['name'] != 'product01.jpg'){
            $imgName = str_replace(' ', '', $img['name']);
        $actualizar = $this->getEscribir()->updateProducto($nombre, $precio, $tipo, 'img/'.str_replace('img/', '', $imgName), $idProducto);
        } else {
            $actualizar = $this->getEscribir()->updateProducto($nombre, $precio, $tipo, str_replace(' ', '', $img['name']), $idProducto);
        }

        if($actualizar && $img['name'] != 'product01.jpg'){

            $this->guardarImagen($img, "../../img/");

            return true;

        } else {

            return false;

        }

    }

    function eliminarPost($idProducto){

        return $this->getEscribir()->deleteProducto($idProducto);

    }



}

