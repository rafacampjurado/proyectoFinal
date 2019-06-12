<?php



class userController {



    private $lectura;

    private $escritura;



    function __construct(Lectura $lectura, Escritura $escritura) {

        $this->lectura = $lectura;

        $this->escritura = $escritura;

    }



    function getLectura() {

        return $this->lectura;

    }



    function getEscritura() {

        return $this->escritura;

    }



    public function guardarImagen($imagen, $usuario, $url) {

        $imgName = str_replace(' ', '', $imagen['name']);

        $nombreFichero = $usuario . '-' .$imgName;

        $nombreTemporal = $imagen['tmp_name'];

        $destino = $url.$nombreFichero;

        return move_uploaded_file($nombreTemporal, $destino);

    }



    public function registrarUsuario($nombre, $apellidos, $email, $usuario, $password, $fecha, $imagen ) {

        $añadirUsuario = $this->getEscritura()->añadirNuevoUsuario($nombre, $apellidos, $email, $usuario, $password, $fecha, $imagen['name']);

        if ($añadirUsuario && $imagen['name'] != 'default.png') {

            $idUsuario = $this->getLectura()->getIdUsuario($usuario);

            $añadirImagen = $this->guardarImagen($imagen, $idUsuario, '../img/user-images/');

        }

        if ($añadirUsuario) {

            return true;

        } else {

            return false;

        }

    }



    public function editarUsuario($nombre, $usuario, $imagen, $apellidos) {

        if (!$nombre && !$apellidos) {

            $actualizarUsuario = $this->getEscritura()->updateImagenUsuario($imagen['name'], $usuario);



            if ($actualizarUsuario && $imagen !== false) {

                $_SESSION['usuario']->setImagen($imagen['name']);

                $añadirImagen = $this->guardarImagen($imagen, $usuario, '../img/user-images/');

            }

        } else {

            $actualizarUsuario = $this->getEscritura()->updateDatosUsuario($nombre, $usuario, $apellidos);

        }



        if ($actualizarUsuario) {

            return true;

        } else {

            return false;

        }

    }



    public function getUsuario($idUsuario) {

        $datosUsuario = $this->getLectura()->getDatosCompletosUsuario($idUsuario)[0];

        return new Usuario($datosUsuario['usuario'], $idUsuario, $datosUsuario['rol'], $datosUsuario['apellidos'], $datosUsuario['email'], $datosUsuario['imagen'], $datosUsuario['fecha'], array());

    }



    public function loginUsuario($usuario, $password) {

        $checkLogin = $this->getLectura()->existeUsuario($usuario, $password);

        if ($checkLogin) {

            $idUsuario = $this->getLectura()->getIdUsuario($usuario);

            $datosUsuario = $this->getLectura()->getDatosUsuario($idUsuario)[0];

            $_SESSION['usuario'] = new Usuario($usuario, $idUsuario, $datosUsuario['rol'], $datosUsuario['apellidos'], $datosUsuario['email'], $datosUsuario['imagen'], $datosUsuario['fecha'], array());

            return true;

        } else {

            return FALSE;

        }

    }



    public function logout() {

        unset($_SESSION['usuario']);

    }



    public function datosPersonales($idUsuario) {

        $datosUsuario = $this->getLectura()->getDatosUsuario($idUsuario);



        return userPanelViews::verDatosPersonales($datosUsuario);

    }



    public function listadoFacturasUsuario($idUsuario) {

        $facturas = $this->getLectura()->getFacturasUsuario($idUsuario);

        return userPanelViews::verFacturas($facturas);

    }



    public function listadoComentariosUsuario($idUsuario) {

        $comentarios = $this->getLectura()->getOpinionesUsuario($idUsuario);

        return userPanelViews::listadoComentarios($comentarios);

    }



    public function listadoMetodosPagosUsuario($idUsuario) {

        $metodosPagos = $this->getLectura()->getMetodosPago($idUsuario);

        $direccionesGuardadas = $this->getLectura()->getDireccionUsuario($idUsuario);

        return userPanelViews::listadoMetodosPagos($metodosPagos, $direccionesGuardadas);

    }



    public function añadirDireccionUsuario($alias, $calle, $codigoPostal, $telefono, $ciudad, $pais, $idUsuario) {

        return $this->getEscritura()->añadirDireccionUsuario($alias, $calle, $codigoPostal, $telefono, $ciudad, $pais, $idUsuario);

    }



    public function generarPedido($idUsuario, $fecha, $idDireccion, $idTarjeta) {

        $factura = $this->getEscritura()->añadirFactura($idUsuario, $fecha, $idDireccion, $idTarjeta);

        if ($factura) {

            $idFactura = $this->getLectura()->getUltimoIdFactura($idUsuario);

            foreach ($_SESSION['usuario']->getCarrito() as $producto) {

                $añadir = $this->getEscritura()->añadirFacturasProductos($idFactura, $producto->getIdProduct(), $producto->getCantidad());

            }

            $_SESSION['usuario']->eliminarTodosLosProductos();

            return $añadir;

        } else {

            return $factura;

        }

    }



    public function getDirecciones($idUsuario) {

        return $this->getLectura()->getDireccionUsuario($idUsuario);

    }



    public function getMetodosDePago($idUsuario) {

        return $this->getLectura()->getMetodosPago($idUsuario);

    }



////////////////////////////////////////////////////////////////////////////////

    /////////////////////////// ADMINISTRACIÓN ////////////////////////////////

    public function adminEditarUsuario($idUsuario) {

        $usuario = $this->getUsuario($idUsuario);

        return UsuarioView::formEditarUsuario($usuario);

    }



    public function listadoUsuarios() {

        $usuarios = $this->getLectura()->getAllUsers();

        return UsuarioView::listadoUsuarios($usuarios);

    }



    function actualizarUsuario($usuario, $email, $rol, $fecha, $imagen, $idUsuario) {

        $actualizar = $this->getEscritura()->updateUsuario($usuario, $email, $rol, $fecha, str_replace(' ', '', $imagen['name']) , $idUsuario);

        if ($actualizar) {

            $this->guardarImagen($imagen, $idUsuario, '../../img/user-images/');

            return true;

        } else {

            return false;

        }

    }

    function eliminarUsuario($idUsuario){

        $this->getEscritura()->deleteUsuario($idUsuario);

    }



}

