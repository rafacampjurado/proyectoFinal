<?php

class Escritura {

    const SQL_AÑADIR_COMENTARIO = 'Insert into opiniones (idUsuario,idProducto,Opinion,Puntuacion,Fecha) VALUES(:idUsuario,:idProducto,:opinion,:puntuacion,:fecha)';
    const SQL_AÑADIR_FACTURA = 'INSERT INTO facturas (idUsuario, Fecha, idDireccion, idTarjetaCredito) values(:id, :fecha, :idDireccion, :idTarjeta)';
    const SQL_AÑADIR_FACTURA_PRODUCTOS = 'INSERT INTO facturas_productos VALUES(:idFactura, :idProducto, :cantidad)';
    const SQL_REGISTRO_USER = 'INSERT INTO usuarios (nombre,apellidos,email,usuario,password,fecha,imagen) values (:nombre, :apellidos, :email, :usuario, :password, :fecha, :imagen)';
    const SQL_UPDATE_USER = 'UPDATE usuarios SET '
            . ' nombre = :nombre ,'
            . ' apellidos = :apellidos '
            . ' WHERE idUsuario = :idUsuario';
    const SQL_UPDATE_COMENTARIO_POR_ID = 'UPDATE opiniones SET '
            . ' Opinion = :opinion,'
            . ' Puntuacion = :puntuacion'
            . ' WHERE idOpinion = :idOpinion';
    const SQL_DELETE_COMENTARIO_POR_ID = 'DELETE FROM opiniones WHERE opiniones.idOpinion = :idOpinion';
    const SQL_AÑADIR_NUEVA_TARJETA = 'INSERT INTO tarjetasdecredito (numeroTarjeta, tipo, idUsuario) values (:numeroTarjeta, :tipo, :idUsuario)';
    const SQL_AÑADIR_NUEVA_DIRECCION = 'INSERT INTO direcciones_usuario (alias, calle, codigoPostal, telefono, ciudad, pais, idUsuario) '
            . 'VALUES (:alias, :calle, :codigoPostal, :telefono, :ciudad, :pais, :idUsuario)';
    const SQL_DELETE_TARJETA_USUARIO = 'DELETE FROM tarjetasdecredito WHERE idTarjetaCredito = :idTarjeta AND idUsuario = :idUsuario';
    const SQL_DELETE_DIRECCION_USUARIO = 'DELETE FROM direcciones_usuario WHERE idDireccion = :idDireccion AND idUsuario = :idUsuario';
    const SQL_UPDATE_IMAGEN = 'UPDATE usuarios SET imagen = :imagen WHERE idUsuario = :idUsuario';
    const SQL_INSERT_NUEVO_PRODUCTO = 'INSERT INTO productos (Nombre,Precio,Tipo,Img) VALUES(:nombre, :precio, :tipo, :img)';
    const SQL_UPDATE_PRODUCTO = 'UPDATE productos set Nombre = :nombre , Precio = :precio , Tipo = :tipo , Img = :img WHERE idProducto = :idProducto';
    const SQL_DELETE_PRODUCTO = 'DELETE FROM productos WHERE idProducto = :idProducto';
    const SQL_UPDATE_USUARIO = 'UPDATE usuarios set usuario = :usuario, email = :email, rol = :rol, fecha = :fecha, imagen = :imagen WHERE idUsuario = :idUsuario';
    const SQL_DELETE_USUARIO = 'DELETE FROM usuarios WHERE idUsuario = :idUsuario';
    const SQL_UPDATE_APROBACION_COMENTARIO = 'UPDATE opiniones set Aprobado = :aprobacion WHERE idOpinion = :idOpinion';
    const SQL_UPDATE_COMENTARIO = 'UPDATE opiniones set Opinion = :opinion, Fecha = :fecha, Puntuacion = :puntuacion, Aprobado = :aprobado WHERE idOpinion = :idComentario';

    private $conexion;

    public function __construct(Conexion $conexion) {
        $this->conexion = $conexion;
    }

    public function añadirComentario($idUsuario, $idProducto, $opinion, $puntuacion, $fecha) {
        $comentario = $this->conexion->insert(self::SQL_AÑADIR_COMENTARIO, [
            [
                ':idUsuario' => $idUsuario,
                ':idProducto' => $idProducto,
                ':opinion' => $opinion,
                ':puntuacion' => $puntuacion,
                ':fecha' => $fecha
            ]
        ]);
        return $comentario;
    }

    public function añadirFactura($idUsuario, $fecha, $idDireccion, $idTarjeta) {
        $factura = $this->conexion->insert(self::SQL_AÑADIR_FACTURA, [
            [
                ':id' => $idUsuario,
                ':fecha' => $fecha,
                ':idDireccion' => $idDireccion,
                ':idTarjeta' => $idTarjeta
            ]
        ]);
        return $factura;
    }

    public function añadirNuevoUsuario($nombre, $apellidos, $email, $usuario, $password, $fecha, $imagen) {
        $registro = $this->conexion->insert(self::SQL_REGISTRO_USER, [
            [
                ':nombre' => $nombre,
                ':apellidos' => $apellidos,
                ':email' => $email,
                ':usuario' => $usuario,
                ':password' => $password,
                ':fecha' => $fecha,
                ':imagen' => $imagen
            ]
        ]);
        return $registro;
    }

    public function añadirFacturasProductos($idFactura, $idproducto, $cantidad) {
        $productos = $this->conexion->insert(self::SQL_AÑADIR_FACTURA_PRODUCTOS, [
            [
                ':idFactura' => $idFactura,
                ':idProducto' => $idproducto,
                ':cantidad' => $cantidad
            ]
        ]);
        return $productos;
    }

    public function updateDatosUsuario($nombre, $idUsuario, $apellidos) {
        $usuario = $this->conexion->insert(self::SQL_UPDATE_USER, [
            [
                ':nombre' => $nombre,
                ':apellidos' => $apellidos,
                ':idUsuario' => $idUsuario
            ]
        ]);
        return $usuario;
    }

    public function updateComentarioPorID($idOpinion, $puntuacion, $opinion) {
        return $this->conexion->insert(self::SQL_UPDATE_COMENTARIO_POR_ID, [
                    [
                        ':opinion' => $opinion,
                        ':puntuacion' => $puntuacion,
                        ':idOpinion' => $idOpinion
                    ]
        ]);
    }

    public function deleteComentarioPorId($idOpinion) {
        return $this->conexion->select(self::SQL_DELETE_COMENTARIO_POR_ID, [':idOpinion' => $idOpinion]);
    }

    public function añadirNuevaTarjeta($numeroTarjeta, $marcaTarjeta, $idUsuario) {
        $tarjeta = $this->conexion->insert(self::SQL_AÑADIR_NUEVA_TARJETA, [
            [
                ':numeroTarjeta' => $numeroTarjeta,
                ':tipo' => $marcaTarjeta,
                ':idUsuario' => $idUsuario
            ]
        ]);
        return $tarjeta;
    }

    public function deleteTarjetaUsuario($idTarjeta, $idUsuario) {
        return $this->conexion->select(self::SQL_DELETE_TARJETA_USUARIO, [
                    ':idTarjeta' => $idTarjeta,
                    ':idUsuario' => $idUsuario
        ]);
    }

    public function añadirDireccionUsuario($alias, $calle, $codigoPostal, $telefono, $ciudad, $pais, $idUsuario) {
        return $this->conexion->insert(self::SQL_AÑADIR_NUEVA_DIRECCION, [
                    [
                        ':alias' => $alias,
                        ':calle' => $calle,
                        ':codigoPostal' => $codigoPostal,
                        ':telefono' => $telefono,
                        ':ciudad' => $ciudad,
                        ':pais' => $pais,
                        ':idUsuario' => $idUsuario
                    ]
        ]);
    }

    public function deleteDireccionUsuario($idDireccion, $idUsuario) {
        return $this->conexion->select(self::SQL_DELETE_DIRECCION_USUARIO, [
                    ':idDireccion' => $idDireccion,
                    ':idUsuario' => $idUsuario
        ]);
    }

    public function updateImagenUsuario($imagen, $idUsuario) {
        return $this->conexion->insert(self::SQL_UPDATE_IMAGEN, [
                    [
                        ':imagen' => $imagen,
                        ':idUsuario' => $idUsuario
                    ]
        ]);
    }

    ////////////////////////////////////////////////////////////////////////////
    ////////////////    ADMINITRACIÓN  /////////////////////////////////////////
    public function añadirNuevoProducto($nombre, $precio, $tipo, $img) {
        return $this->conexion->insert(self::SQL_INSERT_NUEVO_PRODUCTO, [
                    [
                        ':nombre' => $nombre,
                        ':precio' => $precio,
                        ':tipo' => $tipo,
                        ':img' => $img
                    ]
        ]);
    }

    public function updateProducto($nombre, $precio, $tipo, $img, $idProducto) {
        return $this->conexion->insert(self::SQL_UPDATE_PRODUCTO, [
                    [
                        ':nombre' => $nombre,
                        ':precio' => $precio,
                        ':tipo' => $tipo,
                        ':img' => $img,
                        ':idProducto' => $idProducto
                    ]
        ]);
    }

    public function deleteProducto($idProducto) {
        return $this->conexion->select(self::SQL_DELETE_PRODUCTO, [':idProducto' => $idProducto]);
    }

    public function updateUsuario($usuario, $email, $rol, $fecha, $imagen, $idUsuario) {
        return $this->conexion->insert(self::SQL_UPDATE_USUARIO, [
                    [
                        ':usuario' => $usuario,
                        ':email' => $email,
                        ':rol' => $rol,
                        ':imagen' => $imagen,
                        ':fecha' => $fecha,
                        ':idUsuario' => $idUsuario
                    ]
        ]);
    }

    public function deleteUsuario($idUsuario) {
        return $this->conexion->select(self::SQL_DELETE_USUARIO, [':idUsuario' => $idUsuario]);
    }

    public function actualizarAprobacionComentario($idComentario, $aprobacion) {
        return $this->conexion->insert(self::SQL_UPDATE_APROBACION_COMENTARIO, [
                    [
                        ':idOpinion' => $idComentario,
                        ':aprobacion' => $aprobacion
                    ]
        ]);
    }

    public function actualizarComentario($idComentario, $opinion, $fecha, $puntuacion, $aprobado) {
        return $this->conexion->insert(self::SQL_UPDATE_COMENTARIO, [
                    [
                        ':opinion' => $opinion,
                        ':fecha' => $fecha,
                        ':puntuacion' => $puntuacion,
                        ':aprobado' => $aprobado,
                        ':idComentario' => $idComentario
                    ]
        ]);
    }

}
