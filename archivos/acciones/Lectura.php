<?php

class Lectura {

    const SQL_CHECK_USUARIO = 'SELECT usuario,password FROM usuarios WHERE usuario=:usuario and password = :password';
    const SQL_GET_ID_USUARIO = 'SELECT idUsuario FROM usuarios WHERE usuario=:usuario;';
    const SQL_GET_SINGLE_PRODUCT = 'SELECT idProducto,nombre,tipo,precio,img FROM productos WHERE idProducto=:id';
    const SQL_CONTAR_OPINIONES_DE_PRODUCTO = 'SELECT count(idOpinion) as opiniones FROM opiniones WHERE idProducto=:id and Aprobado = 1 ;';
    const SQL_GET_OPINIONES_DE_PRODUCTO = 'SELECT usuario, Opinion, Fecha, Puntuacion FROM `opiniones` 

                            INNER JOIN usuarios on opiniones.idUsuario=usuarios.idUsuario 

                            WHERE idProducto=:id LIMIT 0,3 and Aprobado = 1';
    const SQL_GET_OPINIONES_POR_USUARIO = 'SELECT idOpinion, Opinion, Fecha, Puntuacion, img, Nombre, productos.idProducto FROM opiniones '
            . ' INNER JOIN productos on opiniones.idProducto=productos.idProducto '
            . ' WHERE idUsuario = :idUsuario and Aprobado = 1';
    const SQL_GET_PRODUCTOS = 'SELECT * from productos where tipo=:tipo LIMIT 0,6';
    const SQL_GET_PRODUCTOS_LIMITE = 'SELECT * from productos where tipo=:tipo LIMIT :limit';
    const SQL_CHECK_COMENTARIO = 'SELECT idOpinion from opiniones where idUsuario = :idUsuario AND idProducto = :idProducto';
    const SQL_GET_CANTIDAD_PRODUCTOS_POR_TIPO = 'Select count(idProducto)as productos from productos where tipo = :tipo';
    const SQL_GET_ULTIMO_ID_FACTURA = 'SELECT idFactura FROM facturas WHERE idUsuario = :id ORDER BY idFactura DESC LIMIT 1';
    const SQL_GET_FACTURAS_POR_CLIENTE = 'SELECT facturas.idFactura as id, facturas.Fecha as fecha, productos.Nombre as nombre,productos.Img as imagen, facturas_productos.cantidad as cantidad, 

                                            productos.precio, productos.tipo, direcciones_usuario.alias as direccion , tarjetasdecredito.tipo as tarjeta

                                            FROM facturas

                                            INNER JOIN facturas_productos ON facturas.idFactura=facturas_productos.idFactura

                                            INNER JOIN productos ON facturas_productos.idProducto=productos.idProducto

                                            INNER JOIN direcciones_usuario on facturas.idDireccion = direcciones_usuario.idDireccion

                                            INNER JOIN tarjetasdecredito on facturas.idTarjetaCredito = tarjetasdecredito.idTarjetaCredito

                                            WHERE facturas.idUsuario = :idUsuario

                                            ORDER BY fecha DESC';
    const SQL_GET_PRODUCTOS_RELACIONADOS = 'SELECT idProducto,nombre,precio,img,tipo from productos 

                                    where tipo = :tipo 

                                    ORDER BY rand() LIMIT 4';
    const SQL_GET_ULTIMOS_PRODUCTOS_VENDIDOS = 'SELECT productos.idProducto, facturas.Fecha, productos.Nombre, productos.Tipo, productos.img, productos.precio

                                                FROM facturas

                                                INNER JOIN facturas_productos on facturas_productos.idFactura=facturas.idFactura

                                                INNER JOIN productos on facturas_productos.idProducto=productos.idProducto

                                                ORDER BY facturas.Fecha DESC LIMIT 6';
    const SQL_GET_COMENTARIOS_PRODUCTO_LIMIT = 'SELECT usuario, Opinion, opiniones.Fecha, Puntuacion 

                                                FROM `opiniones`INNER JOIN usuarios on opiniones.idUsuario=usuarios.idUsuario 

                                                WHERE idProducto = :idProducto and Aprobado = 1 LIMIT :limite ,3 ';
    const SQL_GET_PRODUCTOS_LIMIT = 'SELECT * FROM productos where Tipo = :tipo LIMIT  :limite , 6';
    const SQL_GET_DATOS_USER = 'SELECT nombre,apellidos,email,rol,imagen,fecha FROM usuarios where idUsuario = :idUsuario';
    const SQL_GET_DATOS_USER_COMPLETOS = 'SELECT * FROM usuarios where idUsuario = :idUsuario';
    const SQL_GET_COMENTARIO_POR_ID = 'SELECT * FROM opiniones where idOpinion = :idOpinion';
    const SQL_GET_METODOS_PAGO_POR_USUARIO = 'SELECT idTarjetaCredito, numeroTarjeta, tipo FROM tarjetasdecredito WHERE idUsuario = :idUsuario';
    const SQL_GET_DIRECCION_USUARIO = 'SELECT idDireccion, alias, calle, codigoPostal, telefono, ciudad, pais FROM direcciones_usuario WHERE idUsuario = :idUsuario';
    const SQL_GET_ROL_USUARIO = 'SELECT rol FROM usuarios WHERE idUsuario = :idUsuario';
    const SQL_GET_ALL_PRODUCTOS = 'SELECT * FROM productos';
    const SQL_GET_ALL_USERS = 'SELECT * FROM usuarios';
    const SQL_GET_ALL_COMENTARIOS = 'SELECT idOpinion, usuarios.usuario, productos.Nombre as producto,  Opinion , opiniones.Fecha, Puntuacion, Aprobado, productos.Img, productos.idProducto '
            . 'FROM opiniones  '
            . ' INNER JOIN usuarios on usuarios.idUsuario = opiniones.idUsuario '
            . ' INNER JOIN productos on productos.idProducto = opiniones.idProducto ';

    private $conexion;

    public function __construct(Conexion $conexion) {

        $this->conexion = $conexion;
    }

    public function existeUsuario($usuario, $password) {

        $credenciales = $this->conexion->select(self::SQL_CHECK_USUARIO, [':usuario' => $usuario, ':password' => $password]);

        $check;

        if (count($credenciales) > 0) {

            $check = true;
        } else {

            $check = false;
        }

        return $check;
    }

    public function getIdUsuario($usuario) {

        $idUsuario = $this->conexion->select(self::SQL_GET_ID_USUARIO, [':usuario' => $usuario]);



        return $idUsuario[0]['idUsuario'];
    }

    public function getSingleProduct($id) {

        $producto = $this->conexion->select(self::SQL_GET_SINGLE_PRODUCT, [':id' => $id]);

        return $producto;
    }

    public function getProductos($tipo) {

        $productos = $this->conexion->select(self::SQL_GET_PRODUCTOS, [':tipo' => $tipo]);

        return $productos;
    }

    public function getProductosLimite($limite = 12) {

        $productos = $this->conexion->select(self::SQL_GET_PRODUCTOS_LIMITE, $limite, ":limite");

        return $productos;
    }

    public function getCountOpinionesProducto($id) {

        $countOpiniones = $this->conexion->select(self::SQL_CONTAR_OPINIONES_DE_PRODUCTO, [':id' => $id]);

        $opiniones = $countOpiniones[0]['opiniones'];

        return $opiniones;
    }

    public function getOpinionesProducto($idProducto) {

        $opiniones = $this->conexion->select(self::SQL_GET_OPINIONES_DE_PRODUCTO, [':id' => $idProducto]);

        return $opiniones;
    }

    public function getCantidadProductosPorTipo($tipo) {

        $productos = $this->conexion->select(self::SQL_GET_CANTIDAD_PRODUCTOS_POR_TIPO, [':tipo' => $tipo]);

        return $productos[0]['productos'];
    }

    public function getUltimoIdFactura($idUsuario) {

        $idFactura = $this->conexion->select(self::SQL_GET_ULTIMO_ID_FACTURA, [':id' => $idUsuario]);

        return $idFactura[0]['idFactura'];
    }

    public function getFacturasUsuario($idUsuario) {

        $facturas = $this->conexion->select(self::SQL_GET_FACTURAS_POR_CLIENTE, [':idUsuario' => $idUsuario]);

        return $facturas;
    }

    public function checkExisteOpinion($idUsuario, $idProducto) {

        $check = $this->conexion->select(self::SQL_CHECK_COMENTARIO, [':idProducto' => $idProducto, ':idUsuario' => $idUsuario]);


        if ($check[0]['idOpinion'] > 0) {

            return true;
        } else {

            return false;
        }
    }

    public function getProductosRelacionados($tipoProducto) {

        $productos = $this->conexion->select(self::SQL_GET_PRODUCTOS_RELACIONADOS, [':tipo' => $tipoProducto]);

        return $productos;
    }

    public function getUltimosProductosVendidos() {

        $productos = $this->conexion->select(self::SQL_GET_ULTIMOS_PRODUCTOS_VENDIDOS);

        return $productos;
    }

    public function buscarComentarios($limite, $idProduto) {

        $paramWhere = ":idProducto";

        return $this->conexion->selectLimit(self::SQL_GET_COMENTARIOS_PRODUCTO_LIMIT, $limite, $idProduto, $paramWhere);
    }

    public function buscarProductosLimit($tipo, $limite) {

        $paramWhere = ":tipo";

        return $this->conexion->selectLimit(self::SQL_GET_PRODUCTOS_LIMIT, $limite, $tipo, $paramWhere);
    }

    public function getDatosUsuario($idUsuario) {

        return $this->conexion->select(self::SQL_GET_DATOS_USER, [':idUsuario' => $idUsuario]);
    }

    public function getOpinionesUsuario($idUsuario) {

        return $this->conexion->select(self::SQL_GET_OPINIONES_POR_USUARIO, [':idUsuario' => $idUsuario]);
    }

    public function getOpinionPorIdOpinion($idOpinion) {

        return $this->conexion->select(self::SQL_GET_COMENTARIO_POR_ID, [':idOpinion' => $idOpinion]);
    }

    public function getMetodosPago($idUsuario) {

        return $this->conexion->select(self::SQL_GET_METODOS_PAGO_POR_USUARIO, [':idUsuario' => $idUsuario]);
    }

    public function getDireccionUsuario($idUsuario) {

        return $this->conexion->select(self::SQL_GET_DIRECCION_USUARIO, [':idUsuario' => $idUsuario]);
    }

    public function getRolUsuario($idUsuario) {

        return $this->conexion->select(self::SQL_GET_ROL_USUARIO, [':idUsuario' => $idUsuario]);
    }

    public function loggin($user, $password) {

        $credenciales = $this->getCredencialesUsuario($user);

        $pass = md5($password);

        if ($user == $credenciales[0]['usuario'] && $pass == $credenciales[0]['password']) {

            $loggin = true;
        } else {

            $loggin = false;
        }

        return $loggin;
    }

    ////////////////////////////////////////////////////////////////////////////



    public function getAllProducts() {

        return $this->conexion->select(self::SQL_GET_ALL_PRODUCTOS);
    }

    public function getDatosCompletosUsuario($idUsuario) {

        return $this->conexion->select(self::SQL_GET_DATOS_USER_COMPLETOS, [':idUsuario' => $idUsuario]);
    }

    public function getAllUsers() {

        return $this->conexion->select(self::SQL_GET_ALL_USERS);
    }

    public function listadoComentarios() {

        return $this->conexion->select(self::SQL_GET_ALL_COMENTARIOS);
    }

}
