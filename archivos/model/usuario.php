<?php

class Usuario {

    private $usuario;
    private $idUsuario;
    private $rol;
    private $apellidos;
    private $email;
    private $imagen;
    private $fecha;
    private $carrito;

    function __construct($usuario, $idUsuario, $rol, $apellidos, $email, $imagen, $fecha, $carrito) {
        $this->usuario = $usuario;
        $this->idUsuario = $idUsuario;
        $this->rol = $rol;
        $this->apellidos = $apellidos;
        $this->email = $email;
        $this->imagen = $imagen;
        $this->fecha = $fecha;
        $this->carrito = $carrito;
    }

    function getUsuario() {
        return $this->usuario;
    }

    function getIdUsuario() {
        return $this->idUsuario;
    }

    function getRol() {
        return $this->rol;
    }

    function getApellidos() {
        return $this->apellidos;
    }

    function getEmail() {
        return $this->email;
    }

    function getImagen() {
        return $this->imagen;
    }

    function getFecha() {
        return $this->fecha;
    }

    function getCarrito() {
        return $this->carrito;
    }

    function setImagen($imagen) {
        $this->imagen = $imagen;
    }

    function setCarrito($carrito) {
        $this->carrito = $carrito;
    }

    function añadirNuevoProducto($objeto) {
        $this->carrito[] = $objeto;
    }

    function eliminarProducto($index) {
        unset($this->carrito[$index]);
    }

    function eliminarTodosLosProductos() {
        $this->carrito = array();
    }

}
